<?php
return array(
    'fields' => array(
        'name' => array(
            'default' => array(
                'name' => 'Name',
                'visibility' => 1,
                'required' => 1,
                'exportCSV' => 1,
            ),
            'type' => 'text',
        ),
        'email' => array(
            'default' => array(
                'name' => 'Email',
                'visibility' => 1,
                'required' => 1,
                'exportCSV' => 1,
            ),
            'type' => 'email',
        ),  
        'phone' => array(
            'default' => array(
                'name' => 'Phone',
                'visibility' => 1,
                'required' => 0,
                'exportCSV' => 1,
            ),
            'type' => 'text',
        ),          
        'subject' => array(
            'default' => array(
                'name' => 'Subject',
                'visibility' => 1,
                'required' => 1,
                'exportCSV' => 1,
            ),
            'type' => 'text',
        ),          
        'message' => array(
            'default' => array(
                'name' => 'Message',
                'visibility' => 1,
                'required' => 1,
                'exportCSV' => 1,
            ),
            'type' => 'textarea',
        ), 
//        'subscribe' => array(
//            'default' => array(
//                'name' => 'Subscribe',
//                'visibility' => 0,
//                'required' => 0,
//                'exportCSV' => 1,
//            ),
//            'type' => 'checkbox',
//        ),
        'captcha' => array(
            'default' => array(
                'name' => 'Captcha',
                'visibility' => 1,
                'required' => 1,
                'exportCSV' => 0,
            ),
            'type' => 'captcha',
        ),            
    ),
    'userParams' => array(
        'name' => array(
            'label' => 'Name',
            'type' => 'text'
        ),
        'visibility' => array(
            'label' => 'Visibility',
            'type' => 'checkbox',

        ),
        'required' => array(
            'label' => 'Required',
            'type' => 'checkbox',
        ),                    
        'exportCSV' => array(
            'label' => 'Export to CSV',
            'type' => 'checkbox',
        ),                            
    ),
    'errors' => array(
        'required_error' => array(
            'label' => 'Required Field',
            'default' => "This field is required",
        ),
        'email_error' => array(
            'label' => 'Email Field',
            'default' => "Email address isn't correct. Please fill this field in carefully",
        ),
        'captcha_error' => array(
            'label' => 'Captcha Field',
            'default' => "Captcha isn't correct. Please fill this field in carefully",
        ),
        'number_error' => array(
            'label' => 'Number Field',
            'default' => "Number isn't correct. Please fill this field in carefully",
        ),
    ),
);