<?php

namespace DeliciousBrains\WPMDB;

class WPMigrateDB {

	public $container, $is_pro, $is_addon, $util, $settingsClass, $props, $propsInstance, $filesystem, $profile_manager, $plugin_manager, $backup_export;
	private $compatibility_manager;

	public function __construct() {
		$container = Container::getInstance();

		$this->props                 = $container->get( 'properties' );
		$this->util                  = $container->get( 'util' );
		$this->profile_manager       = $container->get( 'profile_manager' );
		$this->backup_export         = $container->get( 'backup_export' );
		$this->compatibility_manager = $container->get( 'compatibility_manager' );
	}

	public function registerCommon() {
		add_action( 'init', array( $this, 'loadPluginTextDomain' ) );
		add_action( 'admin_init', array( $this->util, 'maybe_schema_update' ) );

		// For Firefox extend "Cache-Control" header to include 'no-store' so that refresh after migration doesn't override JS set values.
		add_filter( 'nocache_headers', array( $this->util, 'nocache_headers' ) );

		$this->profile_manager->register();
		$this->backup_export->register();
		$this->compatibility_manager->register();
	}

	public function loadPluginTextDomain() {
		$this->util->load_plugin_textdomain( $this->props->plugin_file_path );
	}
}
