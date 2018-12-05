<?php
/*
Plugin Name: WP Migrate DB Pro
Plugin URI: https://deliciousbrains.com/wp-migrate-db-pro/
Description: Export, push, and pull to migrate your WordPress databases.
Author: Delicious Brains
Version: 1.9b1
Author URI: https://deliciousbrains.com
Network: True
Text Domain: wp-migrate-db
Domain Path: /languages/
*/

// Copyright (c) 2013 Delicious Brains. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************

$GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['version'] = '1.9b1';
$GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['folder']  = basename( plugin_dir_path( __FILE__ ) );
$GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['abspath'] = dirname( __FILE__ );

if ( ! defined( 'WPMDB_MINIMUM_PHP_VERSION' ) ) {
	define( 'WPMDB_MINIMUM_PHP_VERSION', '5.4' );
}

if ( version_compare( phpversion(), WPMDB_MINIMUM_PHP_VERSION, '>=' ) ) {
	require_once __DIR__ . '/class/autoload.php';
	require_once __DIR__ . '/setup-mdb-pro.php';
}

function wpmdbpro_is_ajax() {
	// must be doing AJAX the WordPress way
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		return false;
	}

	// must be one of our actions -- e.g. core plugin (wpmdb_*), media files (wpmdbmf_*)
	if ( ! isset( $_POST['action'] ) || 0 !== strpos( $_POST['action'], 'wpmdb' ) ) {
		return false;
	}

	// must be on blog #1 (first site) if multisite
	if ( is_multisite() && 1 != get_current_site()->id ) {
		return false;
	}

	return true;
}

/**
 * once all plugins are loaded, load up the rest of this plugin
 *
 * @return boolean
 */
function wp_migrate_db_pro_loaded() {

	if ( ! function_exists( 'wp_migrate_db_pro' ) ) {
		return false;
	}

	// load if it is wp-cli, so that version update will show in wp-cli
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		wp_migrate_db_pro();

		return true;
	}

	// exit quickly unless: standalone admin; one of our AJAX calls
	if ( ! is_admin() || ( is_multisite() && ! current_user_can( 'manage_network_options' ) && ! wpmdbpro_is_ajax() ) ) {
		return false;
	}
	// Remove the compatibility plugin when the plugin is deactivated
	register_deactivation_hook( __FILE__, 'wpmdb_pro_remove_mu_plugin' );
	wp_migrate_db_pro();

	return true;
}

add_action( 'plugins_loaded', 'wp_migrate_db_pro_loaded' );

if ( ! function_exists( 'wpmdb_deactivate_other_instances' ) ) {
	require_once __DIR__ . '/class/deactivate.php';
}

add_action( 'activated_plugin', 'wpmdb_deactivate_other_instances' );

if ( ! class_exists( 'WPMDB_PHP_Checker' ) ) {
	require_once __DIR__ . '/php-checker.php';
}

$php_checker = new WPMDB_PHP_Checker( __FILE__ );
if ( version_compare( PHP_VERSION, WPMDB_MINIMUM_PHP_VERSION, '<' ) ) {
	register_activation_hook( __FILE__, array( 'WPMDB_PHP_Checker', 'wpmdb_pro_php_version_too_low' ) );
}

function wpmdb_pro_remove_mu_plugin() {
	do_action( 'wp_migrate_db_remove_compatibility_plugin' );
}

