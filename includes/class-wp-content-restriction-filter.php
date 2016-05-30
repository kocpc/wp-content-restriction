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
     * Enqueue script and stylesheet
     * 
     * @since 0.1
     */
    public static function enqueue_script_and_style() {
        // Import Toddish popup library with jQuery (depend)
        wp_enqueue_script( 'toddish-popup', plugins_url( '/js/jquery.popup.min.js', CR_PLUGIN_PATH_FULL ), array( 'jquery' ) );
        
        // Import Toddish popup style
        wp_enqueue_style( 'toddish-popup', plugins_url( '/css/popup.min.css', CR_PLUGIN_PATH_FULL ) );
        
        // Import WP Content Restriction stylesheet
        wp_enqueue_style( 'wp-content-restriction', plugins_url( '/css/wp-content-restriction.min.css', CR_PLUGIN_PATH_FULL ) );
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
        
        // Get author id and convert to int
        $author_id = absint( $post->post_author );
        
        // Get user setting from user meta and return value
        return get_user_meta( $author_id, 'wpcr-restrict-all', true );
        
    }
    
}