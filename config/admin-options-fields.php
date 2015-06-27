<?php
return array(
    'scfp_form_settings' => array(
        'sections' => array(
            'field_settings' => array(
                'label' => 'Fields Settings',
            ),            
            'send_button_settings' => array(
                'label' => 'Send Button',
            ),                     
            'thankyou_page_settings' => array(
                'label' => '"Thank You" Page',
            ),            
            'html5_validation_settings' => array(
                'label' => 'HTML5 Validation',
            ),                        
        ),
        'fields' => array(
            'field_settings' => array(
                'type' => 'metabox',
                'label' => '',
                'default' => '',
                'section' => 'field_settings',
                'class' => '',
                'note' => '',
                'atts' => array(
                ),                
            ),            
            'button_name' => array(
                'type' => 'text',
                'label' => 'Caption',
                'default' => 'Send',
                'section' => 'send_button_settings',
                'class' => 'widefat regular-text',
                'note' => '',
                'atts' => array(
                ),                
            ),            
            'button_color' => array(
                'type' => 'colorpicker',
                'label' => 'Background Color',
                'default' => '#404040',
                'section' => 'send_button_settings',
                'class' => 'scfp-color-picker',
                'note' => '',
                'atts' => array(
                ),                                
            ),
            'text_color' => array(
                'type' => 'colorpicker',
                'label' => 'Text Color',
                'default' => '#FFF',
                'section' => 'send_button_settings',
                'class' => 'scfp-color-picker',
                'note' => '',
                'atts' => array(
                ),                                
            ),        
            'page_name' => array(
                'type' => 'select',
                'label' => 'Page',
                'fieldSet' => 'pages',
                'default' => '',
                'section' => 'thankyou_page_settings',
                'class' => 'widefat regular-select',
            ),      
            'html5_enabled' => array(
                'type' => 'checkbox',
                'label' => 'Enabled',
                'default' => 1,
                'section' => 'html5_validation_settings',
                'class' => '',
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
                'note' => 'Default email address is used from: Settings --> General --> E-mail Address',
                'atts' => array(
                ),                
            ),            
            'subject' => array(
                'type' => 'text',
                'label' => 'Subject',
                'default' => 'New submission from contact form',
                'section' => 'admin_notifications_settings',
                'class' => 'widefat regular-text',
                'note' => '',
                'atts' => array(
                ),                
            ),                        
            'message' => array(
                'type' => 'textarea',
                'label' => 'Message',
                'default' => "Dear {\$admin_name},\nYou got a new message from contact form!\n\nForm message:\n{\$data}",
                'section' => 'admin_notifications_settings',
                'class' => 'widefat',
                'note' => 'Variables:<br/>{$admin_name} - Administrator name<br/>{$user_name} - User name<br/>{$data} - Form data',
                'atts' => array(
                ),                
            ),  
            'disable' => array(
                'type' => 'checkbox',
                'label' => 'Disable Admin Notifications',
                'default' => 0,
                'section' => 'admin_notifications_settings',
                'class' => '',
            ),                                                  
            'user_email' => array(
                'type' => 'select',
                'label' => 'User Email Field',
                'fieldSet' => 'emails',
                'default' => 'email',
                'section' => 'user_notifications_settings',
                'class' => 'widefat regular-select',
                'note' => '',
                'atts' => array(
                ),                
            ),                                    
            'user_subject' => array(
                'type' => 'text',
                'label' => 'Subject',
                'default' => 'Form submission confirmation',
                'section' => 'user_notifications_settings',
                'class' => 'widefat regular-text',
                'note' => '',
                'atts' => array(
                ),                
            ),                        
            'user_message' => array(
                'type' => 'textarea',
                'label' => 'message',
                'default' => "Dear {\$user_name},\nThanks for contacting us!\nWe will get in touch with you shortly.\n\nYour message:\n{\$data}",
                'section' => 'user_notifications_settings',
                'class' => 'widefat',
                'note' => 'Variables:<br/>{$admin_name} - Administrator name<br/>{$user_name} - User name<br/>{$data} - Form data',
                'atts' => array(
                ),                
            ),  
            'user_disable' => array(
                'type' => 'checkbox',
                'label' => 'Disable User Notifications',
                'default' => 0,
                'section' => 'user_notifications_settings',
                'class' => '',
            ),               
            
        ),
    ),        
);