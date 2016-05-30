<?php
/**
 * WP Content Restriction
 * Render notice box
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

if( 0 >= CR_PLUGIN_VERSION ) {
    return die( 'Do not direct access this file.' );
}
?>
<div class="wp-content-restriction-notice-box">
    <div class="wp-content-restriction-notice-box-header">
        <p class="wp-content-restriction-notice-box-title"><?php echo $value['title'] ?></p>
    </div>
    <div class="wp-content-restriction-notice-box-body">
        <p class="wp-content-restriction-notice-box-content"><?php echo $value['body'] ?></p>
    </div>
    <div class="wp-content-restriction-notice-box-footer">
        <button class="wp-content-restriction-notice-box-accept"><?php echo $value['accept'] ?></button>
        <a class="wp-content-restriction-notice-box-decline" href="<?php echo $value['redirect'] ?>" rel="nofollow"><?php echo $value['decline'] ?></a>
    </div>
</div>