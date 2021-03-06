<?php
/**
 * WP Content Restriction
 * User options template.
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
<h2><?php _e( 'Content Restriction', CR_PLUGIN_TEXT_DOMAIN ) ?></h2>
<table class="form-table">
    <?php if( $allowed_restrict_archive ): ?>
    <tr>
        <th>
            <label><?php _e( 'Restrict Author Page', CR_PLUGIN_TEXT_DOMAIN ) ?></label>
        </th>
        <td>
            <input type="checkbox" name="wpcr-restrict-author-page" value="1" <?php echo ( $current_settings['list'] ? 'checked' : null ) ?> />
            <span> <?php _e( 'Select this option to restrict your author page.', CR_PLUGIN_TEXT_DOMAIN ) ?></span>
        </td>
    </tr>
    <?php endif; ?>
    <?php if( $allowed_restrict_all ): ?>
    <tr>
        <th>
            <label><?php _e( 'Restrict All Post', CR_PLUGIN_TEXT_DOMAIN ) ?></label>
        </th>
        <td>
            <input type="checkbox" name="wpcr-restrict-all" value="1" <?php echo ( $current_settings['all'] ? 'checked' : null ) ?> />
            <span> <?php _e( 'Select this option to restrict all your posts', CR_PLUGIN_TEXT_DOMAIN ) ?></span>
        </td>
    </tr>
    <?php endif; ?>
</table>