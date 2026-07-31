<?php
/**
 * Plugin Name: Odawara Sewing Studio
 * Plugin URI: https://www.odawaramishin.sling.name/
 * Description: 小田原ミシン 生地計算・型紙・ソーイングプラットフォーム
 * Version: 0.1.0-alpha
 * Author: 小田原ミシン
 * License: GPL2+
 * Text Domain: odawara-sewing-studio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OSS_VERSION', '0.1.0-alpha' );
define( 'OSS_PLUGIN_FILE', __FILE__ );
define( 'OSS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'OSS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once OSS_PLUGIN_PATH . 'app/Core/Autoloader.php';

OSS\Core\Autoloader::register();

add_action( 'plugins_loaded', function () {
	OSS\Core\Application::boot();
} );