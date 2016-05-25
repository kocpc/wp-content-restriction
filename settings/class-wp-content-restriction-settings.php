<?php
/**
 * WP Content Restriction
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

include_once( CR_PLUGIN_BASE_FULL . '/settings/class-wp-content-restriction-settings-field.php' );

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
        
        // Add setting sections
        add_action( 'admin_init', array( 'WP_Content_Restriction_Settings', 'setting_options_handler' ) );
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
    
    /**
     * Setting options handler
     * 
     * @since 0.1
     */
    public static function setting_options_handler() {
        // General Options
        add_settings_section(
            'general-options',
            __( 'General Options', CR_PLUGIN_TEXT_DOMAIN ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        add_settings_field(
            'allow-restrict-self-page',
            __( 'Restrict Author Page', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_allow_restrict_self_page' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'general-options'
        );
        add_settings_field(
            'allow-restrict-all-post',
            __( 'Restrict All Post by User', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_allow_restrict_all_post' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'general-options'
        );
        
        // Custom Options
        add_settings_section(
            'custom',
            __( 'Custom', CR_PLUGIN_TEXT_DOMAIN ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        
    }
    
}