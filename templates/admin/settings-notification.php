<?php 
    $settings = SCFP()->getSettings();
    $key = $settings->getNotificationKey();
    $data = $settings->getNotification();
?>
<h3>Admin Notifications</h3>
<table class="form-table">
    <tbody>
        <tr>
            <th>Send to Email</th>
            <td>
                <input class="widefat regular-text" type="text" name="<?php echo $key; ?>[another_email]" value="<?php echo esc_attr( $data['another_email'] ); ?>">
                <p class="description">Default email address is used from: Settings --> General --> E-mail Address</p>                
            </td>
        </tr>
        <tr>
            <th>Subject</th>
            <td><input class="widefat regular-text" type="text" name="<?php echo $key; ?>[subject]" value="<?php echo esc_attr( $data['subject'] ); ?>"></td>
        </tr>
        <tr>
            <th>Message</th>
            <td>
                <textarea rows="6" class="widefat" name="<?php echo $key; ?>[message]"><?php echo esc_attr( $data['message'] ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>Disable Admin Notifications</th>
            <td>
                <input type="checkbox" name="<?php echo $key; ?>[disable]" <?php checked( !empty($data['disable']) ); ?>>
            </td>
        </tr>
    </tbody>
</table>    
<h3>User Notifications</h3>
<table class="form-table">
    <tbody>
        <tr>
            <th>Subject</th>
            <td><input class="widefat regular-text" type="text" name="<?php echo $key; ?>[user_subject]" value="<?php echo esc_attr( $data['user_subject'] ); ?>"></td>
        </tr>
        <tr>
            <th>Message</th>
            <td>
                <textarea rows="6" class="widefat" name="<?php echo $key; ?>[user_message]"><?php echo esc_attr( $data['user_message'] ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>Disable User Notifications</th>
            <td>
                <input type="checkbox" name="<?php echo $key; ?>[user_disable]" <?php checked( !empty($data['user_disable']) ); ?>>
            </td>
        </tr>
    </tbody>
</table>    