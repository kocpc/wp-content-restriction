<?php
/**
 * WP Content Restriction
 * Render meta box on editor
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

/**
 * If file is opened directly, return 403 error
 */
if( ! function_exists ('add_action') ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
?>
<p>
    <input type="checkbox" name="wpcr-enable-restriction" id="wpcr-enable-restriction" value="1" <?php echo ( $current_status ? 'checked' : null ) ?> />
    <label for="wpcr-enable-restriction"><?php _e( 'Restrict this post', CR_PLUGIN_TEXT_DOMAIN ) ?></label>
</p>