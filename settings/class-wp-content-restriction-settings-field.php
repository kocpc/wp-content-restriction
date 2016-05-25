<?php
/**
 * WP Content Restriction Settings Field Handler
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

class WP_Content_Restriction_Settings_Field {
    
    public static function element_allow_restrict_self_page() {
        
        // Get option value from database
        $value = get_option( 'wpcr-allow-restrict-self-page' );
        
        // Checkbox whether checked
        $checked = checked( $value );
        
        // Return Element
        echo "<input type='checkbox' name='wpcr-allow-restrict-self-page' value='1' {$checked} /> ";
        _e( 'Whether allow users restrict author page himself?', CR_PLUGIN_TEXT_DOMAIN );
        
    }
    
    public static function element_allow_restrict_all_post() {
        
        // Get option value from database
        $value = get_option( 'wpcr-allow-restrict-all-post' );
        
        // Checkbox whether checked
        $checked = checked( $value );
        
        // Return Element
        echo "<input type='checkbox' name='wpcr-allow-restrict-all-post' value='1' ${checked} /> ";
        _e( 'Whether allow users restrict all him published post?', CR_PLUGIN_TEXT_DOMAIN );
        
    }
    
    public static function element_message_title() {
        
        // Get option value from database
        $value = get_option( 'wpcr-message-title' );
        
        // Placeholder
        $placeholder = __( 'Notice message title.', CR_PLUGIN_TEXT_DOMAIN );
        
        // Return element
        echo "<input class='regular-text' type='text' name='wpcr-message-title' value='{$value}' placeholder='{$placeholder}' />";
        
    }
    
    public static function element_message_body() {
        
        // Get option value from database
        $value = get_option( 'wpcr-message-body' );
        
        // Placeholder
        $placeholder = __( 'Notice message body content.', CR_PLUGIN_TEXT_DOMAIN );
        
        // Return element
        echo "<input class='regular-text' type='text' name='wpcr-message-body' value='{$value}' placeholder='{$placeholder}' />";
        
    }
    
    public static function element_custom_accept_button() {
        
        // Get option value from database
        $value = get_option( 'wpcr-accept-button' );
        
        // Placeholder
        $placeholder = __( 'Custom accept button text. Default: Accept' ,CR_PLUGIN_TEXT_DOMAIN );
    
        // Return element
        echo "<input class='regular-text' type='text' name='wpcr-accept-button' value='{$value}' placeholder='{$placeholder}' />";
        
    }
    
}