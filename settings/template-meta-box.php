<?php
/**
 * WP Content Restriction
 * Render meta box on editor
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

if( 0 >= CR_PLUGIN_VERSION ) {
    return die( 'Do not direct access this file.' );
}
?>
<p>
    <input type="checkbox" name="wpcr-enable-restriction" id="wpcr-enable-restriction" value="1" <?php echo ( $current_status ? 'checked' : null ) ?> />
    <label for="wpcr-enable-restriction"><?php _e( 'Restrict this post', CR_PLUGIN_TEXT_DOMAIN ) ?></label>
</p>