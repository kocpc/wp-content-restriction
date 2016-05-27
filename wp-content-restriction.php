<?php
/**
 * WP Content Restriction
 *
 * Plugin Name: WP Content Restriction
 * Description: Restrict your content, pass after read notice or alert.
 * Author: Hiram Huang <me@hiram.tw>
 * Author URI: https://www.facebook.com/naxqihao
 * Version: 0.1
 * Text Domain: wp-content-restriction
 * Domain Path: /languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @author      Hiram Huang <me@hiram.tw>
 * @package     wp-content-restriction
 * @license     http://www.gnu.org/licenses/gpl-3.0.txt
 * @link        Github Repo: https://github.com/chown9835/wp-content-restriction
 * @since       0.1
 */

// avoid direct access this file 
if( ! defined( 'ABSPATH' ) ) {
	die( 'Do not direct access this file.' );
}

/**
 * Defines plugin named constant
 */
define( 'CR_PLUGIN_VERSION', 0.1 );
define( 'CR_PLUGIN_PATH_FULL', __FILE__ );
define( 'CR_PLUGIN_BASE_FULL', dirname(__FILE__) );
define( 'CR_PLUGIN_BASE_RELATIVE', plugin_basename(__FILE__) );
define( 'CR_PLUGIN_FILE_BASENAME', pathinfo( __FILE__, PATHINFO_FILENAME ) );
define( 'CR_PLUGIN_TEXT_DOMAIN', 'wp-content-restriction' );

/**
 * Load languages
 */
function load_languages() {
    load_plugin_textdomain( CR_PLUGIN_TEXT_DOMAIN, false, CR_PLUGIN_FILE_BASENAME . '/languages' );
}
add_action( 'plugins_loaded', 'load_languages' );

/**
 * Import plugin classes.
 */
include_once( CR_PLUGIN_BASE_FULL . '/settings/class-wp-content-restriction-settings.php' );
include_once( CR_PLUGIN_BASE_FULL . '/includes/class-wp-content-restriction-filter.php' );

/**
 * Initial plugin.
 */
WP_Content_Restriction_Settings::init();
WP_Content_Restriction_Filter::init();