<?php
/**
 * WP Content Restriction
 * Render notice box
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
<div class="wp-content-restriction-notice-box">
    <div class="wp-content-restriction-notice-box-header">
        <p class="wp-content-restriction-notice-box-title"><?php echo $value['title'] ?></p>
    </div>
    <div class="wp-content-restriction-notice-box-body">
        <div class="wp-content-restriction-notice-box-content"><?php echo $value['body'] ?></div>
        <div class="wp-content-restriction-notice-box-a-d"><?php echo $value['ad'] ?></div>
    </div>
    <div class="wp-content-restriction-notice-box-footer">
        <button class="wp-content-restriction-notice-box-accept wp-content-restriction-button"><?php echo $value['accept'] ?></button>
        <a class="wp-content-restriction-notice-box-decline wp-content-restriction-button" href="<?php echo $value['redirect'] ?>" rel="nofollow"><?php echo $value['decline'] ?></a>
    </div>
</div>