<?php
/**
 * WP Content Restriction
 * Post content filter
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

class WP_Content_Restriction_Filter {
    
    /**
     * Initiator
     * 
     * @since 0.1
     */
    public static function init() {
        
        // Register shortcode
        add_action( 'init', array( 'WP_Content_Restriction_Filter', 'register_shortcode_from_list' ) );
        
        // Check author archive page
        add_action( 'loop_start', array( 'WP_Content_Restriction_Filter', 'author_archive_page_filter' ) );
        
        // Post content filter
        add_action( 'the_post', array( 'WP_Content_Restriction_Filter', 'post_page_content_filter' ) );
        
    }
    
    /**
     * Register shortcode
     * 
     * @since 0.1
     */
    public static function register_shortcode_from_list() {
        
        $shortcode_list = get_option( 'wpcr-shortcode-list', false );
        
        if( ! $shortcode_list ) {
            return false;
        }
        
        foreach( $shortcode_list as $shortcode ) {
            
            add_shortcode( $shortcode, array( 'WP_Content_Restriction_Filter', 'shortcode_blank' ) );
            
        }
        
    }
    
    /**
     * Return blank
     * 
     * @since 0.1
     */
    public static function shortcode_blank() {
        return '';
    }
     
    /**
     * Post / page filter
     * 
     * @param object $post The post object
     * @since 0.1
     */
    public static function post_page_content_filter( $post ) {
        
        // Check if not post / page break
        if( ! is_single() && ! is_page() ) {
            return false;
        }
        
        // Check author setting
        if( self::check_user_option( $post ) ) {
            return self::enqueue_script_and_style();
        }
        
        // Check post meta
        if( self::check_post_meta( $post ) ) {
            return self::enqueue_script_and_style();
        }
        
        // Check the shortcode list
        if( self::check_shortcode_list( $post ) ) {
            return self::enqueue_script_and_style();
        }
        
    }
    
    /**
     * Author archive page filter
     * 
     * @since 0.1
     */
    public static function author_archive_page_filter() {
        
        // Check if not author archive page, return
        if( ! is_author() ) {
            return false;
        }
        
        // Check general option
        $allowed_restrict_archive = get_option( 'wpcr-allow-restrict-self-page' );
        
        if( ! $allowed_restrict_archive ) {
            return false;
        }
        
        // Get author id
        $author_id = get_the_author_meta( 'ID' );
        
        // Check user option
        if( get_user_meta( $author_id, 'wpcr-restrict-author-page', true ) ) {
            return self::enqueue_script_and_style();
        }
        
    }
    
    /**
     * Enqueue script and stylesheet
     * 
     * @since 0.1
     */
    public static function enqueue_script_and_style() {
        // Import Toddish popup library with jQuery (depend)
        wp_enqueue_script( 'toddish-popup', plugins_url( '/js/jquery.popup.min.js', CR_PLUGIN_PATH_FULL ), array( 'jquery' ), '2.2.3' );
        
        // Import Toddish popup style
        wp_enqueue_style( 'toddish-popup', plugins_url( '/css/popup.min.css', CR_PLUGIN_PATH_FULL ), null, '2.2.3' );
        
        // Import WP Content Restriction stylesheet
        wp_enqueue_style( 'wp-content-restriction', plugins_url( '/css/wp-content-restriction.min.css', CR_PLUGIN_PATH_FULL ), null, CR_PLUGIN_VERSION );
        
        // Load Google noto font
        wp_enqueue_style( 'google-noto', 'https://fonts.googleapis.com/css?family=Noto+Sans:400,700', array(), 'latest', 'screen' );
        
        // Load notice box template
        add_action( 'wp_footer', array( 'WP_Content_Restriction_Filter', 'render_notice_box_template' ) );
        
        // Load restriction script
        add_action( 'wp_footer', array( 'WP_Content_Restriction_Filter', 'render_restriction_script' ), 100 );
        
    }
    
    /**
     * Check post meta
     * 
     * @param object $post The post object
     * @since 0.1
     */
    public static function check_post_meta( $post ) {
        
        // Set post id
        $post_id = $post->ID;
        
        // Get post meta
        return get_post_meta( $post_id, 'wpcr-enable-restriction', true );
        
    }
    
    /**
     * Check shortcode list
     * 
     * @param object $post The post object
     * @since 0.1
     */
    public static function check_shortcode_list( $post ) {
        
        // Get shortcode list
        $shortcode_list = get_option( 'wpcr-shortcode-list', false );
        
        // If no shortcode list, return back
        if( ! is_array( $shortcode_list ) ) {
            return false;
        }
        
        // Check has shortcode in post content
        foreach( $shortcode_list as $shortcode ) {
            
            if( has_shortcode( $post->post_content, $shortcode ) ) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    /**
     * Check user restriction settings
     * 
     * @param object $post The post object
     * @since 0.1
     */
    public static function check_user_option( $post ) {
        
        // Check global setting
        $allowed_restrict_all = get_option( 'wpcr-allow-restrict-all-post' );
        
        if( ! $allowed_restrict_all ) {
            return false;
        }
        
        // Get author id and convert to int
        $author_id = absint( $post->post_author );
        
        // Get user setting from user meta and return value
        return get_user_meta( $author_id, 'wpcr-restrict-all', true );
        
    }
    
    /**
     * Render notice box template
     * 
     * @since 0.1
     */
    public static function render_notice_box_template() {
        
        // Get global options
        $options = array(
            'title'     => get_option( 'wpcr-message-title' ),
            'body'      => get_option( 'wpcr-message-body' ),
            'accept'    => get_option( 'wpcr-accept-button' ),
            'decline'   => get_option( 'wpcr-decline-button' ),
            'redirect'  => get_option( 'wpcr-decline-redirect' ),
            'ad'        => get_option( 'wpcr-advertisement-code' )
        );
        
        // Set value for render
        $value = array(
            'title'     => $options['title']    ? $options['title']     : __( 'Notice', CR_PLUGIN_TEXT_DOMAIN ),
            'body'      => $options['body']     ? $options['body']      : null,
            'accept'    => $options['accept']   ? $options['accept']    : __( 'Accept', CR_PLUGIN_TEXT_DOMAIN ),
            'decline'   => $options['decline']  ? $options['decline']   : __( 'Decline', CR_PLUGIN_TEXT_DOMAIN ),
            'redirect'  => $options['redirect'] ? $options['redirect']  : get_home_url(),
            'ad'        => $options['ad']       ? $options['ad']        : null
        );
        
        return include_once( CR_PLUGIN_BASE_FULL . '/includes/template-notice-box.php' );
        
    }
    
    /**
     * Render restriction script
     * 
     * @since 0.1
     */
    public static function render_restriction_script() {
        
        return include_once( CR_PLUGIN_BASE_FULL . '/includes/template-restriction-script.php' );
        
    }
    
}