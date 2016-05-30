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
    
        // Render profile options
        add_action( 'show_user_profile', array( 'WP_Content_Restriction_Settings', 'render_user_options' ) );
        add_action( 'edit_user_profile', array( 'WP_Content_Restriction_Settings', 'render_user_options' ) );
        
        // Update profile options
        add_action( 'personal_options_update', array( 'WP_Content_Restriction_Settings', 'update_user_options' ) );
        add_action( 'edit_user_profile_update', array( 'WP_Content_Restriction_Settings', 'update_user_options' ) );
        
        // Add meta box to editor
        add_action( 'add_meta_boxes', array( 'WP_Content_Restriction_Settings', 'meta_boxes_setup' ) );
        
        // Save post meta
        add_action( 'save_post', array( 'WP_Content_Restriction_Settings', 'update_or_create_post_meta' ) );
        
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
            __( 'Use Shortcode Enable Restriction', CR_PLUGIN_TEXT_DOMAIN ),
            null,
            self::CR_PLUGIN_SETTINGS_SLUG
        );
        
        // shortcode list
        add_settings_field(
            'wpcr-shortcode-list',
            __( 'Shortcode List', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings_Field', 'element_shortcode_list' ),
            self::CR_PLUGIN_SETTINGS_SLUG,
            'wpcr-shortcode'
        );
        register_setting( self::CR_PLUGIN_SETTINGS_SLUG, 'wpcr-shortcode-list', array( 'WP_Content_Restriction_Settings', 'shortcode_explode_handler' ) );
        
    }
    
    /**
     * Shortcode explode handler
     * 
     * @param string $input Input from register_setting callback
     * @since 0.1
     */
    public static function shortcode_explode_handler( $input ) {

        // Check input is not null
        if( ! $input || 0 >= strlen( $input ) ) return;
        
        // Explode value
        $input = explode( PHP_EOL, $input );
        
        // Trim value
        $input = array_map( 'trim', $input );
        
        // Return value
        return $input;
        
    }
    
    /**
     * Render user options
     * 
     * @param object $user Current user information
     * @since 0.1
     */
    public static function render_user_options( $user ) {
        
        // Check user has edit permission
        if ( ! current_user_can( 'edit_posts' ) || ! current_user_can( 'edit_pages' ) ) {
            return false;
        }
        
        // Check global settings
        $allowed_restrict_archive = get_option( 'wpcr-allow-restrict-self-page' );
        $allowed_restrict_all = get_option( 'wpcr-allow-restrict-all-post' );
        
        if( ! $allowed_restrict_archive && ! $allowed_restrict_all ) {
            return false;
        }
        
        // Get current settings value and send to template
        $current_settings = array(
            'list' => $user->get( 'wpcr-restrict-author-page' ),
            'all' => $user->get( 'wpcr-restrict-all' )
        );
        
        // Render options template
        include_once( CR_PLUGIN_BASE_FULL . '/settings/template-user-options.php' );
        
    }
    
    /**
     * Update user profile options
     * 
     * @param int $user_id Currnet user's id
     * @since 0.1
     */
    public static function update_user_options( $user_id ) {
        
        // convert user_id to INT
        $user_id = absint( $user_id );
        
        // Check current user can edit post
        if ( ! current_user_can( 'edit_posts' ) || ! current_user_can( 'edit_pages' ) ) {
            return false;
        }
        
        // Update wpcr-restrict-author-page
        if( $_POST['wpcr-restrict-author-page'] ) {
            update_user_meta( $user_id, 'wpcr-restrict-author-page', true );
        } else {
            update_user_meta( $user_id, 'wpcr-restrict-author-page', false );
        }
        
        // Update wpcr-restrict-all
        if( $_POST['wpcr-restrict-all'] ) {
            update_user_meta( $user_id, 'wpcr-restrict-all', true );
        } else {
            update_user_meta( $user_id, 'wpcr-restrict-all', false );
        }
        
    }
    
    /**
     * Setup meta boxes to editor
     * 
     * @since 0.1
     */
    public static function meta_boxes_setup() {
        
        add_meta_box(
            'wpcr-meta-box',
            __( 'Restrict Content', CR_PLUGIN_TEXT_DOMAIN ),
            array( 'WP_Content_Restriction_Settings', 'render_meta_box' ),
            null,
            'side'
        );
        
    }
    
    /**
     * Render meta box
     * 
     * @since 0.1
     */
    public static function render_meta_box() {
        
        // Set post id
        global $post;
        $post_id = $post->ID;
        
        // Current status
        $current_status = get_post_meta( $post_id, 'wpcr-enable-restriction', true );
        
        // Call the template
        include_once( CR_PLUGIN_BASE_FULL . '/settings/template-meta-box.php' );
        
    }
    
    /**
     * Update post meta
     * 
     * @param int $post_id Current post's id
     * @since 0.1
     */
    public static function update_or_create_post_meta( $post_id ) {
        
        // Save POST value to $value_to_save
        $value_to_save = $_POST['wpcr-enable-restriction'];
        
        // Check post value, if has value, update post meta
        if( 1 == $value_to_save ) {
            if( ! add_post_meta( $post_id, 'wpcr-enable-restriction', true, true ) ) {
                update_post_meta( $post_id, 'wpcr-enable-restriction', true );
            }
        } else {
            if( ! add_post_meta( $post_id, 'wpcr-enable-restriction', false, true ) ) {
                update_post_meta( $post_id, 'wpcr-enable-restriction', false );
            }
        }
        
    }
    
}