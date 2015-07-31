<?php
return array(
    'pages' => array('SCFP_Settings', 'getPagesFieldSet'),
    'emails' => array('SCFP_Settings', 'getEmailsFieldSet'),
    'userNames' => array('SCFP_Settings', 'getNamesFieldSet'),
    'fieldTypes' => array(
        'captcha' => 'Captcha',
        'checkbox' => 'Checkbox',
        'email' => 'Email',
        'number' => 'Number',
        'text' => 'Text',
        'textarea' => 'Textarea',
    ),
    'borderStyle' => array (
        'solid' => 'Solid',
        'dotted' => 'Dotted',
        'dashed' => 'Dashed',
    ),
    'buttonPosition' => array(
        'left' => 'Left',
        'right' => 'Right',
        'center' => 'Center',
    ),
);