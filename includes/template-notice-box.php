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
<div id="wp-content-restriction-notice-box">
    <div id="wp-content-restriction-notice-box-header">
        <p id="wp-content-restriction-notice-box-title"><?php echo $value['title'] ?></p>
    </div>
    <div id="wp-content-restriction-notice-box-body">
        <p id="wp-content-restriction-notice-box-content"><?php echo $value['body'] ?></p>
    </div>
    <div id="wp-content-restriction-notice-box-footer">
        <button id="wp-content-restriction-notice-box-accept">
            <?php echo $value['accept'] ?>
        </button>
        <a id="wp-content-restriction-notice-box-decline" href="<?php echo $value['redirect'] ?>" rel="nofollow">
            <?php echo $value['decline'] ?>
        </a>
    </div>
</div>