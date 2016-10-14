<?php
/**
 * WP Content Restriction
 * Global settings template.
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
<div class="wrap">
    <h1><?php _e( 'WP Content Restriction Settings', CR_PLUGIN_TEXT_DOMAIN ) ?></h1>
    <form action="options.php" method="post">
        <?php
            @settings_fields( self::CR_PLUGIN_SETTINGS_SLUG );
            @do_settings_sections( self::CR_PLUGIN_SETTINGS_SLUG );
            @submit_button();
        ?>
    </form>
</div>