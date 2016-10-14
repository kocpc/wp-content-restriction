<?php
/**
 * WP Content Restriction
 * Render restriction script
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
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
    var contentRestrictionOption = {
        closeContent: null,
        backOpacity: '0.9',
        width: '100%',
        modal: true,
        content: $('.wp-content-restriction-notice-box')
    };
    var contentRestrictionPopup = new $.Popup( contentRestrictionOption );
    contentRestrictionPopup.open();
    $('.wp-content-restriction-notice-box-accept').click(function() {
        contentRestrictionPopup.close();
    });
});
</script>