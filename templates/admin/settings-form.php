<?php 
    $settings = SCFP()->getSettings();
    $key = $settings->getFormKey();
    $data = $settings->getForm();
    $config = $settings->getConfig();
?>
<h3>Fields Settings</h3>
<table class="wp-list-table widefat scfp-settings-table">
    <thead>
        <?php foreach( $config['columns'] as $column): ?>
            <th class="manage-column " style="" scope="col"><b><?php echo $column['label'] ?></b></th>
        <?php endforeach; ?>
    </thead>
    <tbody id="the-list">
        <?php foreach( $config['rows'] as $rowkey => $rowvalues): ?>    
            <tr class="type-page status-publish hentry alternate iedit author-self level-0">
                <?php foreach( $config['columns'] as $columnkey=>$column): ?> 
                <td class="post-title page-title column-title">                
                <?php  
                    switch ($column['type']) :
                        case 'text':
                ?>            
                    <input type="<?php echo $column['type']?>" name="<?php echo $key.'[field_settings]['.$rowkey.']['.$columnkey.']'; ?>" value="<?php echo esc_attr( $data['field_settings'][$rowkey][$columnkey]); ?>">
                <?php 
                        break;
                        case 'checkbox':
                        
                        if (empty($rowvalues['readonly'])) :
                ?>  
                    <input type="<?php echo $column['type']?>" name="<?php echo $key.'[field_settings]['.$rowkey.']['.$columnkey.']'; ?>" <?php checked( !empty($data['field_settings'][$rowkey][$columnkey]) ); ?>>
                    
                    <?php else: ?>
                    
                    <input type="hidden" name="<?php echo $key.'[field_settings]['.$rowkey.']['.$columnkey.']'; ?>" value="<?php echo esc_attr( $data['field_settings'][$rowkey][$columnkey]); ?>">
                    <input readonly="readonly" disabled="disabled" type="<?php echo $column['type']?>"<?php checked( !empty($data['field_settings'][$rowkey][$columnkey]) ); ?>>                    
                <?php 
                            endif;
                        break;
                    endswitch;  
                 ?>
                </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h3>Send Button</h3>
<table class="form-table">
    <tbody>
        <tr>
            <th scope="row">Caption</th>
            <td>
                <input class="widefat regular-text" type="text" name="<?php echo $key; ?>[button_name]" value="<?php echo esc_attr( $data['button_name'] ); ?>" />
            </td>
        </tr>        
        <tr>
            <th scope="row">Background Color</th>
            <td>
                <input class="widefat scfp-color-picker" type="text" name="<?php echo $key; ?>[button_color]" value="<?php echo esc_attr( $data['button_color'] ); ?>" />
            </td>
        </tr>                
        <tr>
            <th scope="row">Text Color</th>
            <td>
                <input class="widefat scfp-color-picker" type="text" name="<?php echo $key; ?>[text_color]" value="<?php echo esc_attr( $data['text_color'] ); ?>" />
            </td>
        </tr>                        
    </tbody>
</table>
<h3>"Thank You" Page</h3>
<table class="form-table">
    <tbody>
        <tr>
            <th scope="row">Page</th>
            <td>
                <?php $all_pages = get_pages();?>
                <select class="widefat regular-select" name='<?php echo $key. '[page_name]'; ?>' >
                    <option value=""></option>
                    <?php foreach( $all_pages as $all_pages_key => $all_pages_value):?>
                        <option value="<?php echo $all_pages_value->ID; ?>"<?php selected( $data['page_name'] == $all_pages_value->ID );?>><?php echo $all_pages_value->post_title;?></option>
                    <?php endforeach; ?>
                </select>
       
            </td>
        </tr> 
    </tbody>
</table>
<h3>HTML5 Validation</h3>
<table class="form-table">
    <tbody>
        <tr>
            <th scope="row">Enabled</th>
            <td>
                <input type="checkbox" name="<?php echo $key; ?>[html5_enabled]" <?php checked( !empty($data['html5_enabled'])); ?> />                
            </td>
        </tr>        
    </tbody>
</table>
