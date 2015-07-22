<?php
use Webcodin\WCPContactForm\Core\Agp_Module;
use Webcodin\WCPContactForm\Core\Agp_Session;

class SCFP_Form extends Agp_Module {
    
    private $id;
    
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
        $this->session = Agp_Session::instance();

        $this->captcha = new SimpleCaptcha();
        $this->captcha->resourcesPath = SCFP()->getBaseDir() . "/inc/cool-php-captcha/resources";        
        $this->captcha->session_var = 'captcha-' . $this->id;
        $this->captcha->imageFormat = 'png';
        $this->captcha->scale = 3; 
        $this->captcha->blur = true;
    }

    public function submit($postData) {
        if (!empty($postData['form_id']) && $postData['form_id'] == $this->id ) {        
            
            foreach(SCFP()->getSettings()->getFieldsSettings() as $key => $field) {
                if (!empty($field['visibility'])) {
                    switch ( $field['field_type'] ) {
                        case 'checkbox':
                           $this->data[$key] = !empty($postData['scfp-'.$key ]) ? 1 : 0;
                            break;
                        default:
                            $this->data[$key] = esc_attr($postData['scfp-'.$key ]);
                            break;
                    }
                }
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
        $fields = SCFP()->getSettings()->getFieldsSettings();
        $this->error = array();
        foreach ($this->data as $key => $value) {

            //required_error
           if (!empty($fields[$key]['required']) && empty($value)) {
               $this->error[$key] = 'required_error';
               continue;
           }

           //email_error
           if (!empty($value) && $fields[$key]['field_type'] == 'email'  && !is_email($value)) {
               $this->error[$key] = 'email_error';
               continue;
           }
           
           
           //number_error
           if (!empty($value) && $fields[$key]['field_type'] == 'number' && (!is_numeric($value) || is_numeric($value) && !is_int($value * 1))) {
               $this->error[$key] = 'number_error';
               continue;
           }           

           if ($fields[$key]['field_type'] == 'captcha'  &&  ( empty( $_SESSION['captcha-'.$this->id][$key] ) || strtolower( trim($value ) ) != strtolower( trim($_SESSION['captcha-'.$this->id][$key] ))) ) {
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
                $meta_value = nl2br($value);
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
        $settings = SCFP()->getSettings()->getNotifictionSettings();
        
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
            
            $email_field = !empty($settings['user_email']) ? $settings['user_email'] : 'email';
            
            $to = !empty($this->data[$email_field]) ? $this->data[$email_field] : '';
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
    
    private function getAdminName(){
        $admin_data = get_users( 'role=Administrator' );
        $admin_name = $admin_data[0]->data->display_name;
        
        return $admin_name; 
    }
    
    private function getUserName(){
        $settings = SCFP()->getSettings()->getNotifictionSettings();
        $user_name_field = !empty($settings['user_name']) ? $settings['user_name'] : 'name';
        
        if( get_post_meta( $this->postId , "scfp_{$user_name_field}", true ) ){
            $user_name = get_post_meta( $this->postId , "scfp_{$user_name_field}", true );
        } else {
            $user_name = 'Visitor';
        }
        return $user_name;
    }
    
    private function getUserEmail(){
        $settings = SCFP()->getSettings()->getNotifictionSettings();
        $user_email_field = !empty($settings['user_email']) ? $settings['user_email'] : 'email';
        
        if( get_post_meta( $this->postId , "scfp_{$user_email_field}", true ) ){
            $user_email = get_post_meta( $this->postId , "scfp_{$user_email_field}", true );
        } else {
            $user_email = '';
        }
        return $user_email;
    }    
    
    private function getUserMessage(){
        $data = $this->getTemplate('variables/data', $this->postId );
                
        return $data;
    }
    
    public function applyEmailVars($text) {
        
        if( strpos( $text, '{$admin_name}' ) !== FALSE){

            $admin_name = $this->getAdminName();
            $text =  str_replace( '{$admin_name}', $admin_name, $text );
        }
        
        
        if( strpos( $text, '{$user_name}' ) !== FALSE){

            $user_name = $this->getUserName();
            $text =  str_replace( '{$user_name}', $user_name, $text );
        }
        
        if( strpos( $text, '{$user_email}' ) !== FALSE){
            
            $user_email = $this->getUserEmail();
            $text =  str_replace( '{$user_email}', $user_email, $text );
        }        
        
        if( strpos( $text, '{$data}' ) !== FALSE){

            $data = $this->getUserMessage();
            $text =  str_replace( '{$data}', $data, $text );
        }

       
        return $text;
    }
    
    public function sendHtmlContentType ($content_type) {
        return 'text/html';
    }
    
    private function redirect() {
        $formSettings = SCFP()->getSettings()->getFormSettings();
        $pageId = $formSettings['page_name'];
        if (!empty($pageId)) {
            $location = get_page_link( $pageId );
            wp_redirect( $location );
            die();
        }
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