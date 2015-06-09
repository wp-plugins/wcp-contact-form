<?php
    $id = $params['id'];
    $form = $params['form'];
    $errors = $form->getError();
    $errorSettings = SCFP()->getSettings()->getErrorsSettings();
    $fieldsSettings = SCFP()->getSettings()->getFieldsSettings();
    $formSettings = SCFP()->getSettings()->getFormSettings();
    $formData = $form->getData();    
    
    $button_color = !empty($formSettings['button_color']) ? $formSettings['button_color'] : '#404040';
    $text_color = !empty($formSettings['text_color']) ? $formSettings['text_color'] : '#FFF';    
?>
<?php if( !empty( $errors ) ): ?>
<div class="scfp-form-error">
    <?php foreach( $errors as $errors_key => $errors_value ): ?>
        <div class="scfp-error-item"><span><?php echo $fieldsSettings[$errors_key]['name'];?>:</span> <?php  echo $errorSettings['errors'][$errors_value ] ; ?></div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="scfp-form-content">
    <form class="scfp-form" id="<?php echo $id;?>"  method="post" action=""<?php echo !empty($formSettings['html5_enabled']) ? '' : ' novalidate';?>>
        <input type="hidden" name="form_id" value="<?php echo $id;?>"/>
        <?php 
        foreach( $fieldsSettings as $key => $field ): 
            if (!empty($field['visibility']) && !empty($field['field_type'])) :
                echo SCFP()->getTemplate("form/{$field['field_type']}", array('id' => $id, 'form' => $form, 'key' => $key, 'field' => $field, 'formSettings' => $formSettings, 'formData' => $formData));
            endif;
        endforeach;
        ?>
        <div class="scfp-form-action">
            <input class="scfp-form-submit" style="background: <?php echo $button_color;?>; color: <?php echo $text_color;?>;" type="submit" value="<?php echo $formSettings['button_name']?>">
        </div>        
    </form>
</div>
