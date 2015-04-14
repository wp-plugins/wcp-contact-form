<?php
return array (
    'columns' => array(
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
    ),
    'rows' => array(
        'name' => array(
            'default' => array(
                'name' => 'Name',
                'visibility' => 1,
                'required' => 1,
            ),
            'type' => 'text',
            
        ),
        'email' => array(
            'default' => array(
                'name' => 'Email',
                'visibility' => 1,
                'required' => 1,
            ),
            'type' => 'email',
            'readonly' => TRUE,
        ),  
        'phone' => array(
            'default' => array(
                'name' => 'Phone',
                'visibility' => 1,
                'required' => 0,
            ),
            'type' => 'text',

        ),          
        'subject' => array(
            'default' => array(
                'name' => 'Subject',
                'visibility' => 1,
                'required' => 1,
            ),
            'type' => 'text',

        ),          
        'message' => array(
            'default' => array(
                'name' => 'Message',
                'visibility' => 1,
                'required' => 1,
            ),
            'type' => 'textarea',
            'readonly' => TRUE,
        ),    

    ),    
    

);