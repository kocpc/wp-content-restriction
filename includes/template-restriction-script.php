<?php
/**
 * WP Content Restriction
 * Render restriction script
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

if( 0 >= CR_PLUGIN_VERSION ) {
    return die( 'Do not direct access this file.' );
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