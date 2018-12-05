<?php

namespace DeliciousBrains\WPMDB\Pro;

use DeliciousBrains\WPMDB\WPMigrateDB;

/**
 * Class WPMigrateDBPro
 *
 * Base class for setting up Pro plugin
 *
 * @package DeliciousBrains\WPMDB\Pro
 */
class WPMigrateDBPro extends WPMigrateDB {
	/**
	 * WPMigrateDBPro constructor.
	 */
	public function __construct() {
		WPMigrateDB::__construct();
	}

	/**
	 * Register WordPress hooks here
	 */
	public function register() {
		$this->registerCommon();
		$register_pro = new RegisterPro();
		$register_pro->loadContainer();
		$register_pro->register();
	}
}
