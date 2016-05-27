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
        add_action( 'the_post', array( 'WP_Content_Restriction_Filter', 'post_page_content_filter' ) );
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
        
        // Set post id
        $post_id = $post->ID;
        
        // Get post meta
        $current_restrict_status = get_post_meta( $post_id, 'wpcr-enable-restriction', true );
        
        // Use post option to enable restrict
        if( $current_restrict_status ) {
            return enqueue_script_and_style();
        }
        
        // Check the shortcode list
        if( self::check_shortcode_list( $post ) ) {
            return enqueue_script_and_style();
        }
        
        
    }
    
    /**
     * Enqueue script and stylesheet
     * 
     * @since 0.1
     */
    public static function enqueue_script_and_style() {
        
    }
    
    /**
     * Check shortcode list
     * 
     * @param object $post The post object
     * @since 0.1
     */
    public static function check_shortcode_list( $post ) {
        
        // Get shortcode list
        $shortcode_list = get_option( 'wpcr-shortcode-list' );
        
        // If no shortcode list, return back
        if( ! $shortcode_list ) {
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
    
}