<?php
    $id = isset($params['id']) ? $params['id'] : NULL;
    if (!empty($id)) :
        $row = isset($params['row']) ? $params['row'] : 0;
        $data = !empty($params['data']) ? $params['data'] : NULL;
        $btnClass = empty($data['no_delete']) ? 'button agp-del-row' : 'button disabled';        
        $fieldTypes = SCFP()->getSettings()->getFieldSet('fieldTypes');
        $selectedType = !empty($data['field_type']) ? $data['field_type'] : 'text';
        
?>
<td>
    <select class="widefat" id="<?php echo "{$id}_{$row}_field_type";?>" name="<?php echo "{$id}[field_settings][{$row}][field_type]";?>"<?php echo !empty($data['no_delete']) ? ' disabled="disabled" readonly="readonly"' : ''; ?> >
        <?php 
            foreach( $fieldTypes as $k => $v ):
                $selected = (trim($selectedType) === trim($k)); 
        ?>
                <option value="<?php echo $k; ?>"<?php selected( $selected );?>><?php echo $v;?></option>
        <?php 
            endforeach; 
        ?>
    </select>    
</td>
<td>
    <input class="widefat" type="text" value="<?php echo !empty($data['name']) && !is_array($data['name']) ? $data['name'] : '' ;?>" id="<?php echo "{$id}_{$row}_name";?>" name="<?php echo "{$id}[field_settings][{$row}][name]";?>" />    
</td>
<td>
    <input class="widefat" type="checkbox"<?php checked(!empty($data['visibility']) && !is_array($data['visibility'])); ?> id="<?php echo "{$id}_{$row}_visibility";?>" name="<?php echo "{$id}[field_settings][{$row}][visibility]";?>"<?php echo !empty($data['visibility_readonly']) ? ' disabled="disabled" readonly="readonly"' : ''; ?>/>    
</td>
<td>
    <input class="widefat" type="checkbox"<?php checked(!empty($data['required']) && !is_array($data['required'])); ?> id="<?php echo "{$id}_{$row}_required";?>" name="<?php echo "{$id}[field_settings][{$row}][required]";?>"<?php echo !empty($data['required_readonly']) ? ' disabled="disabled" readonly="readonly"' : ''; ?>/>    
</td>
<td>
    <input class="widefat" type="checkbox"<?php checked(!empty($data['exportCSV']) && !is_array($data['exportCSV'])); ?> id="<?php echo "{$id}_{$row}_exportCSV";?>" name="<?php echo "{$id}[field_settings][{$row}][exportCSV]";?>"<?php echo !empty($data['required_readonly']) ? ' disabled="disabled" readonly="readonly"' : ''; ?>/>    
</td>
<td class="tbl-actions">    
    <a class="button agp-up-row" href="javascript:void(0);" title="Up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
    <a class="button agp-down-row" href="javascript:void(0);" title="Down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
    <a class="<?php echo $btnClass;?>" href="javascript:void(0);" title="Delete"><span class="dashicons dashicons-no"></span></a>
</td>                
<?php 
    endif;
