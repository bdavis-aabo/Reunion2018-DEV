<?php


/**
 * Populate the $wpmdbpro global with an instance of the WPMDBPro class and return it.
 *
 * @return WPMigrateDBPro|$wpmdbpro The one true global instance of the WPMDBPro class.
 */
function wp_migrate_db_pro() {
	// @TODO don't use globals to store instances of plugins
	global $wpmdbpro;

	if ( ! is_null( $wpmdbpro ) ) {
		return $wpmdbpro;
	}

	$wpmdbpro = new DeliciousBrains\WPMDB\Pro\WPMigrateDBPro();
	$wpmdbpro->register();

	return $wpmdbpro;
}

function wpmdb_pro_cli_loaded() {
	// register with wp-cli if it's running, and command hasn't already been defined elsewhere
	if ( defined( 'WP_CLI' ) && WP_CLI && class_exists( '\DeliciousBrains\WPMDB\Pro\Cli\Command' ) && ! class_exists( '\DeliciousBrains\WPMDBCli\Command' ) ) {
		\DeliciousBrains\WPMDB\Pro\Cli\Command::register();
	}
}

add_action( 'plugins_loaded', 'wpmdb_pro_cli_loaded', 20 );

function wpmdb_pro_cli() {
	global $wpmdbpro_cli;

	if ( ! is_null( $wpmdbpro_cli ) ) {
		return $wpmdbpro_cli;
	}

	do_action( 'wp_migrate_db_pro_cli_before_load' );

	$wpmdbpro_cli = \DeliciousBrains\WPMDB\Container::getInstance()->get( 'cli_export' );

	do_action( 'wp_migrate_db_pro_cli_after_load' );

	return $wpmdbpro_cli;
}
