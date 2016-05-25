<?php
/**
 * WP Content Restriction
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

class WP_Content_Restriction_Settings {
    
    const CR_PLUGIN_SETTINGS_SLUG = 'wp-content-restriction-settings';
    
    /**
     * Initiator.
     * 
     * @since 0.1
     */
    public static function init() {
        // Build a submenu in Options menu
        add_action( 'admin_menu', array( 'WP_Content_Restriction_Settings', 'build_option_menu' ) );
    }
    
    /**
     * Build submenu in Options menu
     * 
     * @since 0.1
     */
    public static function build_option_menu() {
        add_options_page(
            __( 'WP Content Restriction Settings', CR_PLUGIN_TEXT_DOMAIN ),
            __( 'WP Content Restriction', CR_PLUGIN_TEXT_DOMAIN ),
            'manage_options',
            self::CR_PLUGIN_SETTINGS_SLUG,
            array(
                'WP_Content_Restriction_Settings',
                'options_page_handler'
            )
        );
    }
    
    /**
     * Options page handler
     * 
     * @since 0.1
     */
    public static function options_page_handler() {
        include_once( CR_PLUGIN_BASE_FULL . '/settings/template-wp-content-restriction-options.php' );
    }
}