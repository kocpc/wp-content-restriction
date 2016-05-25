<div class="wrap">
    <h1><?php _e( 'WP Content Restriction Settings', CR_PLUGIN_TEXT_DOMAIN ) ?></h1>
    <form action="options.php" method="post">
        <?php
            @settings_fields( self::CR_PLUGIN_SETTINGS_SLUG );
            @do_settings_sections( self::CR_PLUGIN_SETTINGS_SECTION_SLUG );
            @submit_button();
        ?>
    </form>
</div>