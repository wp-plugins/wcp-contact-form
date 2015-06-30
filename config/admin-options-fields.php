<?php
return array(
    'scfp_form_settings' => array(
        'sections' => array(
            'field_settings' => array(
                'label' => 'Fields Settings',
            ),            
            'send_button_settings' => array(
                'label' => 'Submit Button',
            ),                     
            'thankyou_page_settings' => array(
                'label' => '"Thank You" Page',
            ),            
//            'html5_validation_settings' => array(
//                'label' => 'HTML5 Validation',
//            ),                        
            'other_settings' => array(
                'label' => 'Other Settings',
            ),                                    
        ),
        'fields' => array(
            'field_settings' => array(
                'type' => 'metabox',
                'label' => '',
                'default' => '',
                'section' => 'field_settings',
                'class' => '',
                'note' => 'You can configure fields of the contact form in the table below. Each field has following available parameters for configuration : '
                . '<strong>Type</strong> - allows to choose field type from preset; '
                . '<strong>Name</strong> - allows to define field label for displaying; '
                . '<strong>Visibility</strong> - allows to enable/disable field visibility; '
                . '<strong>Required</strong> - allows to make field required; '
                . '<strong>Export to CSV</strong> - allows to add field to CSV export.',
                'atts' => array(
                ),                
            ),            
            'button_name' => array(
                'type' => 'text',
                'label' => 'Caption',
                'default' => 'Send',
                'section' => 'send_button_settings',
                'class' => 'widefat regular-text',
                'note' => 'option allows to change submit button text',
                'atts' => array(
                ),                
            ),        
            'page_name' => array(
                'type' => 'select',
                'label' => 'Select Page',
                'fieldSet' => 'pages',
                'default' => '',
                'section' => 'thankyou_page_settings',
                'class' => 'widefat regular-select',
                'note' => 'option allows to set "Thank You" page from the list of existed pages',
            ),      
            'html5_enabled' => array(
                'type' => 'checkbox',
                'label' => 'Enable HTML5 Validation',
                'default' => 1,
                'section' => 'other_settings',
                'note' => 'option allows to enable/disable HTML5 validation on the contact form',
                'class' => '',
            ),                                      
            'tinymce_button_enabled' => array(
                'type' => 'checkbox',
                'label' => 'TinyMCE Support',
                'default' => 1,
                'section' => 'other_settings',
                'note' => 'option allows to enable/disable button in the TinyMCE editor for adding contact form shortcode to editor area',
                'class' => '',
            ),                                                  
        ),
    ),
    'scfp_style_settings' => array(
        'sections' => array(
            'send_button_settings' => array(
                'label' => 'Submit Button',
            ),                     
            'field_style_settings' => array(
                'label' => 'Fields Style',
            ),                                 
        ),  
        'fields' => array(
            'button_color' => array(
                'type' => 'colorpicker',
                'label' => 'Background Color',
                'default' => '#404040',
                'section' => 'send_button_settings',
                'class' => 'scfp-color-picker',
                'note' => 'option allows to change background color of the "Submit" button',
                'atts' => array(
                ),                                
            ),
            'text_color' => array(
                'type' => 'colorpicker',
                'label' => 'Text Color',
                'default' => '#FFF',
                'section' => 'send_button_settings',
                'class' => 'scfp-color-picker',
                'note' => 'option allows to change text color of the "Submit" button',
                'atts' => array(
                ),                                
            ),        
            'field_label_text_color' => array(
                'type' => 'colorpicker',
                'label' => 'Label Color',
                'default' => '',
                'section' => 'field_style_settings',
                'class' => 'scfp-color-picker',
                'note' => 'option allows to change color of field labels (labels are displayed above the form fields)',
                'atts' => array(
                ),                                
            ),                                       
            'field_text_color' => array(
                'type' => 'colorpicker',
                'label' => 'Text Color',
                'default' => '',
                'section' => 'field_style_settings',
                'class' => 'scfp-color-picker',
                'note' => 'option allows to change field text color inside the form fields',
                'atts' => array(
                ),                                
            ),                           
            'no_border' => array(
                'type' => 'checkbox',
                'label' => 'No Border',
                'default' => 0,
                'section' => 'field_style_settings',
                'class' => '',
                'note' => 'option allows to disable border around the form fields'
            ),                  
            'border_size' => array(
                'type' => 'text',
                'label' => 'Border Size',
                'default' => '',
                'section' => 'field_style_settings',
                'class' => 'widefat regular-text',
                'note' => 'option allows to set size of the border around the form fields (positive digital value with "px")',
                'atts' => array(
                ),                
            ),  
            'border_style' => array (
                'type' => 'select',
                'label' => 'Border Style',
                'fieldSet' => 'borderStyle',
                'default' => 'solid',
                'section' => 'field_style_settings',
                'class' => 'widefat regular-select',
                'note' => 'option allows to set style of the border around the form fields',                
            ),
            'border_color' => array(
                'type' => 'colorpicker',
                'label' => 'Border Color',
                'default' => '',
                'section' => 'field_style_settings',
                'class' => 'scfp-color-picker',
                'note' => 'option allows to set color of the border around the form fields',
                'atts' => array(
                ),                                
            ),   
            'no_background' => array(
                'type' => 'checkbox',
                'label' => 'No Background',
                'default' => 0,
                'section' => 'field_style_settings',
                'class' => '',
                'note' => 'option allows to disable background inside the form fields'
            ),      
            'background_color' => array(
                'type' => 'colorpicker',
                'label' => 'Background Color',
                'default' => '',
                'section' => 'field_style_settings',
                'class' => 'scfp-color-picker',
                'note' => 'option allows to set background color inside the form fields',
                'atts' => array(
                ),                                
            ),               
        ),
    ),            
    'scfp_error_settings' => array(
        'sections' => array(
            'error_settings' => array(
                'label' => 'Error Messages',
            ),            
        ),  
        'fields' => array(
            'errors' => array(
                'type' => 'errors',
                'label' => '',
                'default' => '',
                'section' => 'error_settings',
                'class' => '',
                'note' => 'You can change error messages for non-HTML5 validation below',
            ),                                      
        ),
    ),    
    'scfp_notification_settings' => array(
        'sections' => array(
            'admin_notifications_settings' => array(
                'label' => 'Admin Notifications',
            ),            
            'user_notifications_settings' => array(
                'label' => 'User Notifications',
            ),                        
        ),  
        'fields' => array(
            'another_email' => array(
                'type' => 'text',
                'label' => 'Send to Email',
                'default' => '',
                'section' => 'admin_notifications_settings',
                'class' => 'widefat regular-text',
                'note' => 'option allows to set administrator email address for notifications. Default email address is used from: Settings --> General --> E-mail Address',
                'atts' => array(
                ),                
            ),            
            'subject' => array(
                'type' => 'text',
                'label' => 'Subject',
                'default' => 'New submission from contact form',
                'section' => 'admin_notifications_settings',
                'class' => 'widefat regular-text',
                'note' => 'option allows to set default subject of administrator notification message',
                'atts' => array(
                ),                
            ),                        
            'message' => array(
                'type' => 'textarea',
                'label' => 'Message',
                'default' => "Dear {\$admin_name},\nYou have got a new message from contact form!\n\nForm message:\n{\$data}",
                'section' => 'admin_notifications_settings',
                'class' => 'widefat',
                'note' => 'option allows to set default text of administrator notification message. You can use the following variables:<br/>{$admin_name} - Administrator name<br/>{$user_name} - User name<br/>{$data} - Form data',
                'atts' => array(
                ),                
            ),  
            'disable' => array(
                'type' => 'checkbox',
                'label' => 'Disable Admin Notifications',
                'default' => 0,
                'section' => 'admin_notifications_settings',
                'class' => '',
                'note' => 'option allows to disable notifications of new form submissions'
            ),                                                  
            'user_email' => array(
                'type' => 'select',
                'label' => 'User Email Field',
                'fieldSet' => 'emails',
                'default' => 'email',
                'section' => 'user_notifications_settings',
                'class' => 'widefat regular-select',
                'note' => 'option allows to set default field for user notification if you use more than one email field in the contact form',
                'atts' => array(
                ),                
            ),                                    
            'user_subject' => array(
                'type' => 'text',
                'label' => 'Subject',
                'default' => 'Form submission confirmation',
                'section' => 'user_notifications_settings',
                'class' => 'widefat regular-text',
                'note' => 'option allows to set default subject of user notification message',
                'atts' => array(
                ),                
            ),                        
            'user_message' => array(
                'type' => 'textarea',
                'label' => 'message',
                'default' => "Dear {\$user_name},\nThanks for contacting us!\nWe will get in touch with you shortly.\n\nYour message:\n{\$data}",
                'section' => 'user_notifications_settings',
                'class' => 'widefat',
                'note' => 'option allows to set default text of user notification message. You can use the following variables:<br/>{$admin_name} - Administrator name<br/>{$user_name} - User name<br/>{$data} - Form data',
                'atts' => array(
                ),                
            ),  
            'user_disable' => array(
                'type' => 'checkbox',
                'label' => 'Disable User Notifications',
                'default' => 0,
                'section' => 'user_notifications_settings',
                'note' => 'option allows to disable notifications for successful form submission',
                'class' => '',
            ),               
            
        ),
    ),        
);