<?php
    $id = $params['id'];
    $form = $params['form'];
    $errors = $form->getError();
    $errorSettings = SCFP()->getSettings()->getErrorsSettings();
    $fieldsSettings = SCFP()->getSettings()->getFieldsSettings();
    $formSettings = SCFP()->getSettings()->getFormSettings();
    $styleSettings = SCFP()->getSettings()->getStyleSettings();
    $formData = $form->getData();   
    $button_position = !empty($formSettings['button_position']) ? $formSettings['button_position'] : 'left';
    
    $button_color = !empty($styleSettings['button_color']) ? $styleSettings['button_color'] : '';
    $text_color = !empty($styleSettings['text_color']) ? $styleSettings['text_color'] : '';    
    
    $field_label_text_color = !empty($styleSettings['field_label_text_color']) ? $styleSettings['field_label_text_color'] : '';
    $field_text_color = !empty($styleSettings['field_text_color']) ? $styleSettings['field_text_color'] : '';    
    $no_border = !empty($styleSettings['no_border']) ? $styleSettings['no_border'] : '';
    $border_size = !empty($styleSettings['border_size']) ? $styleSettings['border_size'] : '';
    $border_style = !empty($styleSettings['border_style']) ? $styleSettings['border_style'] : '';
    $border_color = !empty($styleSettings['border_color']) ? $styleSettings['border_color'] : '';
    $no_background = !empty($styleSettings['no_background']) ? $styleSettings['no_background'] : '';
    $background_color = !empty($styleSettings['background_color']) ? $styleSettings['background_color'] : '';    
    
    $content_classes = array() ;
    if (!empty($no_border)) {
        $content_classes[] = "scfp-form-noborder"; 
    }
    if (!empty($no_background)) {
        $content_classes[] = "scfp-form-nobackground"; 
    }
    $content_classes = !empty($content_classes) ? ' '.implode(' ', $content_classes) : '';
?>
<style>
    #<?php echo $id;?> .scfp-form-row input, #<?php echo $id;?> .scfp-form-row textarea, #<?php echo $id;?> .scfp-form-row .scfp-captcha-image-wrapper { 
        <?php if (empty($no_border)) : ?>
            <?php if (!empty($border_size)): echo "border-width: $border_size!important;"; endif;?> 
            <?php if (!empty($border_style)): echo "border-style: $border_style!important;"; endif;?> 
            <?php if (!empty($border_color)): echo "border-color: $border_color!important;"; endif;?> 
        <?php endif; ?>               
    }
    #<?php echo $id;?> .scfp-form-row input, #<?php echo $id;?> .scfp-form-row textarea {      
        <?php if (empty($no_background)) : ?>
            <?php if (!empty($background_color)): echo "background-color: $background_color!important;"; endif;?> 
        <?php endif; ?>                
        <?php if (!empty($field_text_color)): echo "color: $field_text_color!important;"; endif;?>         
    }    
    #<?php echo $id;?> .scfp-form-row label {
        <?php if (!empty($field_label_text_color)): echo "color: $field_label_text_color!important;"; endif;?> 
    }   
    #<?php echo $id;?> .scfp-form-row .scfp-form-field:focus:required:valid { border-color: #388e3c!important; }
    #<?php echo $id;?> .scfp-form-row .scfp-form-field:focus:required:invalid, #<?php echo $id;?> .scfp-form-row input[type="checkbox"]:focus:required:invalid { border-color: #d32f2f!important; }
</style>
<?php if( !empty( $errors ) ): ?>
<div class="scfp-form-error">
    <?php foreach( $errors as $errors_key => $errors_value ): ?>
        <div class="scfp-error-item"><span><?php echo $fieldsSettings[$errors_key]['name'];?>:</span> <?php  echo $errorSettings['errors'][$errors_value ] ; ?></div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="scfp-form-content scfp-form-widget<?php echo $content_classes;?>">
    <form class="scfp-form" id="<?php echo $id;?>"  method="post" action=""<?php echo !empty($formSettings['html5_enabled']) ? '' : ' novalidate';?>>
        <input type="hidden" name="form_id" value="<?php echo $id;?>"/>
        <?php 
        foreach( $fieldsSettings as $key => $field ): 
            if (!empty($field['visibility']) && !empty($field['field_type'])) :
                echo SCFP()->getTemplate("form/{$field['field_type']}", array('id' => $id, 'form' => $form, 'key' => $key, 'field' => $field, 'formSettings' => $formSettings, 'formData' => $formData));
            endif;
        endforeach;
        ?>
        <div class="scfp-form-action scfp-form-button-position-<?php echo $button_position;?>">
            <input class="scfp-form-submit" style="background: <?php echo $button_color;?>!important; color: <?php echo $text_color;?>!important;" type="submit" value="<?php echo $formSettings['button_name']?>">
        </div>        
    </form>
</div>