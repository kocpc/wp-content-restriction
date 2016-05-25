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
        $value = get_option( 'allow-restrict-self-page' );
        
        // Checkbox whether checked
        $checked = checked( $value );
        
        // Return Element
        echo "<input type='checkbox' name='allow-restrict-self-page' value='1' {$checked} /> ";
        _e( 'Whether allow users restrict author page himself?', CR_PLUGIN_TEXT_DOMAIN );
        
    }
    
    public static function element_allow_restrict_all_post() {
        
        // Get option value from database
        $value = get_option( 'allow-restrict-all-post' );
        
        // Checkbox whether checked
        $checked = checked( $value );
        
        // Return Element
        echo "<input type='checkbox' name='allow-restrict-all-post' value='1' ${checked} /> ";
        _e( 'Whether allow users restrict all him published post?', CR_PLUGIN_TEXT_DOMAIN );
        
    }
}