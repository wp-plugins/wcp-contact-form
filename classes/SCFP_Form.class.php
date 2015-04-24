<?php

class SCFP_Form extends Agp_Module {
    
    private $id;
    
    private $fields;
    
    private $data = array();
    
    private $error = array();
    
    private $postId;
    
    /**
     * Session
     * 
     * @var Agp_Session
     */
    private $session;
    
    private $captcha;
    
    public function __construct($id) {
        parent::__construct(SCFP()->getBaseDir());        
        $this->id = $id;
        $this->fields = SCFP_Form::getFormFields();
        $this->session = Agp_Session::instance();

        $this->captcha = new SimpleCaptcha();
        $this->captcha->resourcesPath = SCFP()->getBaseDir() . "/inc/cool-php-captcha/resources";        
        $this->captcha->session_var = 'captcha-' . $this->id;
        $this->captcha->imageFormat = 'png';
        //$this->captcha->lineWidth = 3;
        $this->captcha->scale = 3; 
        $this->captcha->blur = true;
    }
    
    public static function getFormFields() {
        $configSettings = SCFP()->getSettings()->getConfig();
        $formSettings = SCFP()->getSettings()->getForm();
        
        foreach ($formSettings['field_settings'] as $fieldName => $values) {
            if (!empty($values['visibility'])) {
                $configSettings['rows'][$fieldName]['values'] = $values;    
            } else {
                unset($configSettings['rows'][$fieldName]);
            }
            
        }
        
        return $configSettings['rows'];        
    }


    public function submit($postData) {
        if (!empty($postData['form_id']) && $postData['form_id'] == $this->id ) {        
            
            foreach($this->fields as $key => $value) {
                $this->data[$key] = nl2br(esc_attr($postData['scfp-'.$key ]));
            }
            
            if ($this->validation()) {
                if ($this->saveForm()) {
                    if ($this->notifiction()) {
                        $this->data = array();
                        $this->redirect();
                    }
                }
            }
        }
    }
    
    public function validation() {
        $this->error = array();
        foreach ($this->data as $key => $value) {

            //required_error
           if (!empty($this->fields[$key]['values']['required']) && empty($value)) {
               $this->error[$key] = 'required_error';
               continue;
           }

           //email_error
           if ($this->fields[$key]['type'] == 'email'  && !is_email($value)) {
               $this->error[$key] = 'email_error';
               continue;
           }
           
           //captcha_error
            if (!empty($this->fields[$key]['values']['required']) && $this->fields[$key]['type'] == 'captcha'  &&  ( empty( $_SESSION['captcha-'.$this->id] ) || strtolower( trim($value ) ) != $_SESSION['captcha-'.$this->id] ) ) {
               $this->error[$key] = 'captcha_error';
               continue;
           }
        }
        
        return empty($this->error);
    }
    
    private function saveForm() {
        $num_entries = $this->getEntriesCount();
        
        $post = array(
            'post_type' => 'form-entries',
            'post_status' => 'unread',
            'post_content' => !empty($this->data['message']) ? $this->data['message'] : '',
        );
  
        $this->postId = wp_insert_post( $post, TRUE );
        
        if (!is_wp_error($this->postId )) {
            
            $i = get_option('entry_counter') && $num_entries ? get_option('entry_counter') : 1;            
            update_post_meta( $this->postId , 'entry_id', $i, true );            
            wp_update_post( array(
                    'ID'           => $this->postId ,
                    'post_title'   => 'Entry #' . $i,
                )
            );            
            update_option('entry_counter', ++$i);
              
            foreach ($this->data as $key => $value) {
                $meta_key = 'scfp_' . $key;
                $meta_value = $value;
                add_post_meta($this->postId , $meta_key, $meta_value);
            }

            return TRUE;
        }

        return FALSE;
    }    
    
    private function getEntriesCount() {
        $query = new WP_Query( 
            array( 'post_status' => array('trash', 'read', 'unread'), 'post_type' => 'form-entries', 'posts_per_page' => -1 ) 
        );
        $num_result = count($query->posts);
        wp_reset_query();
        return $num_result;
    }
    
    public function notifiction() {
        $result = TRUE;
        $settings = SCFP()->getSettings()->getNotification();
        
        if (empty($settings['disable'])) {
            $to = !empty($settings['another_email']) ? $settings['another_email'] : get_option('admin_email');
            $subject = !empty($settings['subject']) ? $settings['subject'] : '';
            $message = $this->applyEmailVars( nl2br(!empty($settings['message']) ? $settings['message'] : '') );
            $content = $this->getTemplate('email/mail-template', array('message' => $message));            

            add_filter( 'wp_mail_content_type', array($this, 'sendHtmlContentType') );        
            if (!empty($to)) {
                wp_mail($to, $subject, $content);
            }
            remove_filter( 'wp_mail_content_type', array($this, 'sendHtmlContentType') );        
        }
        
        if (empty($settings['user_disable'])) {
            $to = !empty($this->data['email']) ? $this->data['email'] : '';
            $subject = !empty($settings['user_subject']) ? $settings['user_subject'] : '';
            $message = $this->applyEmailVars( nl2br(!empty($settings['user_message']) ? $settings['user_message'] : '') );            
            $content = $this->getTemplate('email/mail-template', array('message' => $message));            

            add_filter( 'wp_mail_content_type', array($this, 'sendHtmlContentType') );        
            if (!empty($to)) {
                wp_mail($to, $subject, $content);
            }
            remove_filter( 'wp_mail_content_type', array($this, 'sendHtmlContentType') );        
        }        
        return $result;
    }        
    
    private function get_admin_name(){
        $admin_data = get_users( 'role=Administrator' );
        $admin_name = $admin_data[0]->data->display_name;
        
        return $admin_name; 
    }
    
    private function get_user_name(){
        if( get_post_meta( $this->postId , 'scfp_name', true ) ){
            $user_name = get_post_meta( $this->postId , 'scfp_name', true );
        } else {
            $user_name = 'User';
        }
        return $user_name;
    }
    
    private function get_user_message(){
        $data = $this->getTemplate('variables/data', $this->postId );
                
        return $data;
    }
    
    public function applyEmailVars($text) {
        
        if( strpos( $text, '{$admin_name}' ) !== FALSE){

            $admin_name = $this->get_admin_name();
            $text =  str_replace( '{$admin_name}', $admin_name, $text );
        }
        
        
        if( strpos( $text, '{$user_name}' ) !== FALSE){

            $user_name = $this->get_user_name();
            $text =  str_replace( '{$user_name}', $user_name, $text );
        }
        
        
        if( strpos( $text, '{$data}' ) !== FALSE){

            $data = $this->get_user_message();
            $text =  str_replace( '{$data}', $data, $text );
        }

       
        return $text;
    }
    
    public function sendHtmlContentType ($content_type) {
        return 'text/html';
    }
    
    private function redirect() {
        $formSettings = SCFP()->getSettings()->getForm();
        $pageId = $formSettings['page_name'];
        if (!empty($pageId)) {
            $location = get_page_link( $pageId );
            wp_redirect( $location );
        }
    }
    
    public function getField($fieldName) {
        return $this->fields[$fieldName];
    }
    
    public function getFields() {
        return $this->fields;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getError() {
        return $this->error;
    }
    
    public function getData() {
        return $this->data;
    }
    
    function getSession() {
        return $this->session;
    }

    function getCaptcha() {
        return $this->captcha;
    }

}