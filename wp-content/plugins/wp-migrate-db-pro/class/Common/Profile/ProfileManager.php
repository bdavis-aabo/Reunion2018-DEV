<?php

namespace DeliciousBrains\WPMDB\Common\Profile;

use DeliciousBrains\WPMDB\Common\Error\ErrorLog;
use DeliciousBrains\WPMDB\Common\FormData\FormData;
use DeliciousBrains\WPMDB\Common\Http\Http;
use DeliciousBrains\WPMDB\Common\MigrationState\MigrationStateManager;
use DeliciousBrains\WPMDB\Common\Properties\Properties;
use DeliciousBrains\WPMDB\Common\Settings;
use DeliciousBrains\WPMDB\Common\Sql\Table;
use DeliciousBrains\WPMDB\Common\Util\Util;

class ProfileManager {

	public $default_profile, $checkbox_options, $http, $props, $settings, $state_manager, $util, $error_log, $table;

	public function __construct(
		Http $http,
		Properties $properties,
		Settings $settings,
		MigrationStateManager $state_manager,
		Util $util,
		ErrorLog $error_log,
		Table $table,
		FormData $form_data
	) {
		$this->http          = $http;
		$this->props         = $properties;
		$this->settings      = $settings->get_settings();
		$this->state_manager = $state_manager;
		$this->util          = $util;
		$this->error_log     = $error_log;
		$this->table         = $table;

		$this->default_profile = [
			'action'                    => 'savefile',
			'save_computer'             => '1',
			'gzip_file'                 => '1',
			'table_migrate_option'      => 'migrate_only_with_prefix',
			'replace_guids'             => '1',
			'default_profile'           => true,
			'name'                      => '',
			'select_tables'             => [],
			'select_post_types'         => [],
			'backup_option'             => 'backup_only_with_prefix',
			'exclude_transients'        => '1',
			'compatibility_older_mysql' => '0',
			'import_find_replace'       => '1',
		];

		$this->checkbox_options = [
			'save_computer'             => '0',
			'gzip_file'                 => '0',
			'replace_guids'             => '0',
			'exclude_spam'              => '0',
			'keep_active_plugins'       => '0',
			'create_backup'             => '0',
			'exclude_post_types'        => '0',
			'exclude_transients'        => '0',
			'compatibility_older_mysql' => '0',
			'import_find_replace'       => '0',
		];
		$this->form_data        = $form_data;
	}

	public function register() {

		// internal AJAX handlers
		add_action( 'wp_ajax_wpmdb_delete_migration_profile', array( $this, 'ajax_delete_migration_profile' ) );
		add_action( 'wp_ajax_wpmdb_save_profile', array( $this, 'ajax_save_profile' ) );
		add_action( 'wp_ajax_wpmdb_save_setting', array( $this, 'ajax_save_setting' ) );
		add_action( 'wp_ajax_wpmdb_clear_log', array( $this, 'ajax_clear_log' ) );
		add_action( 'wp_ajax_wpmdb_get_log', array( $this, 'ajax_get_log' ) );
		add_action( 'wp_ajax_wpmdb_whitelist_plugins', array( $this, 'ajax_whitelist_plugins' ) );
		add_action( 'wp_ajax_wpmdb_update_max_request_size', array( $this, 'ajax_update_max_request_size' ) );
		add_action( 'wp_ajax_wpmdb_update_delay_between_requests', array( $this, 'ajax_update_delay_between_requests' ) );
	}

	/**
	 * Handler for deleting a migration profile.
	 *
	 * @return bool|null
	 */
	function ajax_delete_migration_profile() {
		$this->http->check_ajax_referer( 'delete-migration-profile' );

		$key_rules = array(
			'action'     => 'key',
			'profile_id' => 'positive_int',
			'nonce'      => 'key',
		);

		$state_data = $this->state_manager->set_post_data( $key_rules );

		$key = absint( $state_data['profile_id'] );
		-- $key;
		$return = '';

		if ( isset( $this->settings['profiles'][ $key ] ) ) {
			unset( $this->settings['profiles'][ $key ] );
			update_site_option( 'wpmdb_settings', $this->settings );
		} else {
			$return = '-1';
		}

		$result = $this->http->end_ajax( $return );

		return $result;
	}

	/**
	 * Handler for the ajax request to save a migration profile.
	 *
	 * @return bool|null
	 */
	function ajax_save_profile() {
		$this->http->check_ajax_referer( 'save-profile' );

		$key_rules  = array(
			'action'  => 'key',
			'profile' => 'string',
			'nonce'   => 'key',
		);
		$state_data = $this->state_manager->set_post_data( $key_rules );

		$profile = $this->form_data->parse_migration_form_data( $state_data['profile'] );
		$profile = wp_parse_args( $profile, $this->checkbox_options );

		if ( isset( $profile['save_migration_profile_option'] ) && $profile['save_migration_profile_option'] == 'new' ) {
			$profile['name']              = $profile['create_new_profile'];
			$this->settings['profiles'][] = $profile;
		} else {
			$key                                        = $profile['save_migration_profile_option'];
			$name                                       = $this->settings['profiles'][ $key ]['name'];
			$this->settings['profiles'][ $key ]         = $profile;
			$this->settings['profiles'][ $key ]['name'] = $name;
		}

		update_site_option( 'wpmdb_settings', $this->settings );
		end( $this->settings['profiles'] );
		$key    = key( $this->settings['profiles'] );
		$result = $this->http->end_ajax( $key );

		return $result;
	}


	/**
	 * Handler for ajax request to save a setting, e.g. accept pull/push requests setting.
	 *
	 * @return bool|null
	 */
	function ajax_save_setting() {
		$this->http->check_ajax_referer( 'save-setting' );

		$key_rules  = array(
			'action'  => 'key',
			'checked' => 'bool',
			'setting' => 'key',
			'nonce'   => 'key',
		);
		$state_data = $this->state_manager->set_post_data( $key_rules );

		$this->settings[ $state_data['setting'] ] = ( $state_data['checked'] == 'false' ) ? false : true;
		update_site_option( 'wpmdb_settings', $this->settings );
		$result = $this->http->end_ajax();

		return $result;
	}

	function ajax_clear_log() {
		$this->http->check_ajax_referer( 'clear-log' );
		delete_site_option( 'wpmdb_error_log' );
		$result = $this->http->end_ajax();

		return $result;
	}

	function ajax_get_log() {
		$this->http->check_ajax_referer( 'get-log' );
		ob_start();
		$this->error_log->output_diagnostic_info();
		$this->error_log->output_log_file();
		$return = ob_get_clean();
		$result = $this->http->end_ajax( $return );

		return $result;
	}

	/**
	 * Handler for updating the plugins that are not to be loaded during a request (Compatibility Mode).
	 */
	function ajax_whitelist_plugins() {
		$this->http->check_ajax_referer( 'whitelist_plugins' );

		$key_rules  = array(
			'action'            => 'key',
			'whitelist_plugins' => 'array',
		);
		$state_data = $this->state_manager->set_post_data( $key_rules );

		$this->settings['whitelist_plugins'] = (array) $state_data['whitelist_plugins'];
		update_site_option( 'wpmdb_settings', $this->settings );
		exit;
	}

	/**
	 * Updates the Maximum Request Size setting.
	 *
	 * @return void
	 */
	function ajax_update_max_request_size() {
		$this->http->check_ajax_referer( 'update-max-request-size' );

		$key_rules  = array(
			'action'           => 'key',
			'max_request_size' => 'positive_int',
			'nonce'            => 'key',
		);
		$state_data = $this->state_manager->set_post_data( $key_rules );

		$this->settings['max_request'] = (int) $state_data['max_request_size'] * 1024;
		$result                        = update_site_option( 'wpmdb_settings', $this->settings );
		$this->http->end_ajax( $result );
	}

	/**
	 * Updates the Delay Between Requests setting.
	 *
	 * @return void
	 */
	function ajax_update_delay_between_requests() {
		$this->http->check_ajax_referer( 'update-delay-between-requests' );

		$key_rules  = array(
			'action'                 => 'key',
			'delay_between_requests' => 'positive_int',
			'nonce'                  => 'key',
		);
		$state_data = $this->state_manager->set_post_data( $key_rules );

		$this->settings['delay_between_requests'] = (int) $state_data['delay_between_requests'];
		$result                                   = update_site_option( 'wpmdb_settings', $this->settings );
		$this->http->end_ajax( $result );
	}

	function maybe_update_profile( $profile, $profile_id ) {
		$profile_changed = false;

		if ( isset( $profile['exclude_revisions'] ) ) {
			unset( $profile['exclude_revisions'] );
			$profile['select_post_types'] = array( 'revision' );
			$profile_changed              = true;
		}

		if ( isset( $profile['post_type_migrate_option'] ) && 'migrate_select_post_types' == $profile['post_type_migrate_option'] && 'pull' != $profile['action'] ) {
			unset( $profile['post_type_migrate_option'] );
			$profile['exclude_post_types'] = '1';
			$all_post_types                = $this->table->get_post_types();
			$profile['select_post_types']  = array_diff( $all_post_types, $profile['select_post_types'] );
			$profile_changed               = true;
		}

		if ( $profile_changed ) {
			$this->settings['profiles'][ $profile_id ] = $profile;
			update_site_option( 'wpmdb_settings', $this->settings );
		}

		return $profile;
	}

	// Retrieves the specified profile, if -1, returns the default profile
	function get_profile( $profile_id ) {
		-- $profile_id;

		if ( $profile_id == '-1' || ! isset( $this->settings['profiles'][ $profile_id ] ) ) {
			return $this->default_profile;
		}

		return $this->settings['profiles'][ $profile_id ];
	}
}
