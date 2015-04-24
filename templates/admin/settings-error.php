<?php 
    $settings = SCFP()->getSettings();
    $key = $settings->getErrorKey();
    $data = $settings->getError();
    $error_config = $settings->getErrorConfig();
?>
<h3>Error Messages</h3>
<table class="form-table">
    <tbody>
        <?php foreach( $error_config as $error_config_key => $error_config_value): ?>
            <tr>
                <th scope="row"><?php echo $error_config_value['title']; ?></th>
                <td>
                    <input class="widefat" type="text" name="<?php echo $key.'[error_name][' . $error_config_key . ']'; ?>" value="<?php echo esc_attr( $data['error_name'][$error_config_key] ); ?>"/>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>