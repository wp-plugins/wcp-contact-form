<?php 
    $settings = SCFP()->getSettings();
    $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $settings->getFormKey();
?>
<div class="wrap">
    <?php 
        screen_icon();
        settings_errors();
        echo '<h2 class="nav-tab-wrapper">';
        foreach ( $settings->getPluginSettingsTabs() as $tab_key => $tab_caption ) {
            $active = $tab == $tab_key ? 'nav-tab-active' : '';
            echo '<a class="nav-tab ' . $active . '" href="?page=' . $settings->getPluginOptionsKey() . '&tab=' . $tab_key . '">' . $tab_caption . '</a>';
        }
        echo '</h2>';
    ?>
    <form method="post" action="options.php">
        <?php wp_nonce_field( 'update-options' ); ?>
        <?php settings_fields( $tab ); ?>
        <?php            
            switch ($tab) :
                case $settings->getFormKey() :
                    echo SCFP()->getTemplate('admin/settings-form');
                    break;
                case $settings->getErrorKey() :
                    echo SCFP()->getTemplate('admin/settings-error');
                    break;
                case $settings->getNotificationKey() :
                    echo SCFP()->getTemplate('admin/settings-notification');
                    break;
            endswitch;
        ?>
        <?php submit_button(); ?>
    </form>
</div>