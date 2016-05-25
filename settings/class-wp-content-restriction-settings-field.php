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
        $checked = checked( $value, true, false );
        
        // Return Element
        echo "<input type='checkbox' name='wpcr-allow-restrict-self-page' value='1' {$checked} /> ";
        _e( 'Whether allow users restrict author page himself?', CR_PLUGIN_TEXT_DOMAIN );
        
    }
    
    public static function element_allow_restrict_all_post() {
        
        // Get option value from database
        $value = get_option( 'wpcr-allow-restrict-all-post' );
        
        // Checkbox whether checked
        $checked = checked( $value, true, false );
        
        // Return Element
        echo "<input type='checkbox' name='wpcr-allow-restrict-all-post' value='1' ${checked} /> ";
        _e( 'Whether allow users restrict all him published post?', CR_PLUGIN_TEXT_DOMAIN );
        
    }
    
    public static function element_message_title() {
        
        // Get option value from database
        $value = get_option( 'wpcr-message-title' );
        
        // Placeholder
        $placeholder = __( 'Notice message title. Default: Notice', CR_PLUGIN_TEXT_DOMAIN );
        
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
    
    public static function element_custom_decline_button() {
        
        // Get option value form database
        $value = get_option( 'wpcr-decline-button' );
        
        // Placeholder
        $placeholder = __( 'Custom decline button text. Default: Decline', CR_PLUGIN_TEXT_DOMAIN );
        
        // Return element
        echo "<input class='regular-text' type='text' name='wpcr-decline-button' value='{$value}' placeholder='{$placeholder}' />";
        
    }
    
    public static function element_custom_decline_redirect() {
        
        // Get option value from database
        $value = get_option( 'wpcr-decline-redirect' );
        
        // Placeholder
        $placeholder = __( 'Custom decline redirect URL. Default: Homepage', CR_PLUGIN_TEXT_DOMAIN );
        
        // Return element
        echo "<input class='regular-text' type='text' name='wpcr-decline-redirect' value='{$value}' placeholder='{$placeholder}' />";
        
    }
    
    public static function element_advertisement_code() {
        
        // Get option value from database
        $value = get_option( 'wpcr-advertisement-code' );
        
        // Placeholder
        $placeholder = __( 'You can put your advertisement code or tracking code here.', CR_PLUGIN_TEXT_DOMAIN );
        
        // Return element
        echo "<textarea class='large-text' name='wpcr-advertisement-code' rows='8' placeholder='{$placeholder}'>{$value}</textarea>";
        
    }
    
    public static function element_shortcode_list() {
        
        // Get option value from database
        $value = get_option( 'wpcr-shortcode-list' );
        
        // If value not null, replace array to text
        if( is_array( $value ) && 0 < count( $value ) ) {
            foreach( $value as $shortcode ) {
                if( ! isset( $output ) ) {
                    $output = $shortcode;
                } else {
                    $output .= PHP_EOL . $shortcode;
                }
            }
            $value = $output;
        }
        
        // Placeholder
        $placeholder = __( 'Multiple shortcode use <Enter> to separate.', CR_PLUGIN_TEXT_DOMAIN );
        
        // Return element
        echo "<textarea class='large-text' name='wpcr-shortcode-list' rows='5' placeholder='{$placeholder}'>{$value}</textarea>";
        
    }
    
}