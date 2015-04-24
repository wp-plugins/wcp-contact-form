<?php
    $id = $params['id'];
    $form = $params['form'];
    $errors = $form->getError();
    $data = $form->getFields();
    $form_data = $form->getData();
    $error_settings = SCFP()->getSettings()->getError();
    $form_settings = SCFP()->getSettings()->getForm();
    $button_color = !empty($form_settings['button_color']) ? $form_settings['button_color'] : '#404040';
    $text_color = !empty($form_settings['text_color']) ? $form_settings['text_color'] : '#FFF';    
?>
    <?php if( !empty( $errors ) ): ?>
    <div class="scfp-form-error">
        <?php foreach( $errors as $errors_key => $errors_value ): ?>
            <div class="scfp-error-item"><span><?php echo $data[$errors_key]['values']['name'];?>:</span> <?php  echo $error_settings['error_name'][$errors_value ] ; ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
<div class="scfp-form-content">
    <form class="scfp-form" id="<?php echo $id;?>"  method="post" action="">
        <input type="hidden" name="form_id" value="<?php echo $id;?>"/>
            <?php foreach( $data as $datakey => $datavalue ): ?>
                <?php if (!empty($data[$datakey]['values']['visibility'])) : ?>
                    <?php 
                        switch ( $datavalue['type'] ):
                            case 'text':
                            case 'email':    
                    ?> 
                        <div class="scfp-form-row">
                            <label class="scfp-form-label" for="scfp-<?php echo $datakey; ?>"><?php echo $data[$datakey]['values']['name'];?><?php if ( !empty( $data[$datakey]['values']['required'] ) ) : ?> <span class="scfp-form-field-required">*</span><?php endif;?></label>
                            <input class="scfp-form-field" type="<?php echo !empty($form_settings['html5_enabled']) ? $datavalue['type'] : 'text';?>" id="scfp-<?php echo $datakey; ?>" name="scfp-<?php echo $datakey; ?>" <?php if ( !empty( $data[$datakey]['values']['required'] ) && !empty($form_settings['html5_enabled']) ) : ?> required <?php endif;?> value="<?php if( !empty($form_data ) ): echo $form_data[$datakey]; endif; ?>">
                        </div>
                    <?php 
                            break;
                            case 'textarea':
                    ?> 
                        <div class="scfp-form-row">
                            <label class="scfp-form-label" for="scfp-<?php echo $datakey; ?>"><?php echo $data[$datakey]['values']['name']?><?php if ( !empty( $data[$datakey]['values']['required'] ) )  : ?> <span class="scfp-form-field-required">*</span><?php endif;?></label>
                            <textarea class="scfp-form-field scfp-form-message-field" id="scfp-<?php echo $datakey; ?>" name="scfp-<?php echo $datakey;?>" <?php if ( !empty( $data[$datakey]['values']['required'] ) && !empty($form_settings['html5_enabled']) ) : ?>  required <?php endif;?> ><?php if( !empty($form_data ) ): echo $form_data[$datakey]; endif; ?></textarea>
                        </div>
                    <?php endswitch;?>
                <?php endif;?>
            <?php endforeach; ?>
        <div class="scfp-form-action">
            <input class="scfp-form-submit" style="background: <?php echo $button_color;?>; color: <?php echo $text_color;?>;" type="submit" value="<?php echo $form_settings['button_name']?>">
        </div>
    </form>
</div>