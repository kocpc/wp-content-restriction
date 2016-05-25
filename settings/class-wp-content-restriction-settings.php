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
        
        /**
         * General Options
         */
        add_settings_section(
            'wpcr-general-options',
            __( 'General Options', CR_PLUGIN_TEXT_DOMAIN ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        
        // Whether allow user restrict author page himself
        add_settings_field(
            'wpcr-allow-restrict-self-page',
            __( 'Restrict Author Page', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_allow_restrict_self_page' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-general-options'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-allow-restrict-self-page' );
        
        // Whether allow user restrict all post himself
        add_settings_field(
            'wpcr-allow-restrict-all-post',
            __( 'Restrict All Post by User', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_allow_restrict_all_post' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-general-options'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-allow-restrict-all-post' );
        
        /**
         * Messages
         */
        add_settings_section(
            'wpcr-messages',
            __( 'Messages Box', CR_PLUGIN_TEXT_DOMAIN ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        
        // Message title
        add_settings_field(
            'wpcr-message-title',
            __( 'Message Title', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_message_title' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-messages'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-message-title' );
        
        // Message Body
        add_settings_field(
            'wpcr-message-body',
            __( 'Message Body', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_message_body' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-messages'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-message-body' );
        
        // Accept button
        add_settings_field(
            'wpcr-accept-button',
            __( 'Accept Button', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_custom_accept_button' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-messages'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-accept-button' );
        
        // Decline button
        add_settings_field(
            'wpcr-decline-button',
            __( 'Decline Button', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_custom_decline_button' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-messages'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-decline-button' );
        
        // Decline redirect
        add_settings_field(
            'wpcr-decline-redirect',
            __( 'Decline Redirect', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_custom_decline_redirect' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-messages'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-decline-redirect' );
        
        /**
         * Advertisement
         */
        add_settings_section(
            'wpcr-advertisement',
            __( 'Advertisement', CR_PLUGIN_TEXT_DOMAIN ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        
        // Advertisement code
        add_settings_field(
            'wpcr-advertisement-code',
            __( 'Advertise Code', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_advertisement_code' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-advertisement'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-advertisement-code' );
        
        /**
         * Shortcode
         */
        add_settings_section(
            'wpcr-shortcode',
            __( 'Use Shortcode Enable Restriction' ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        
        // shortcode list
        add_settings_field(
            'wpcr-shortcode-list',
            __( 'Shortcode List ', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_shortcode_list' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-shortcode'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-shortcode-list' );
        
    }
    
}