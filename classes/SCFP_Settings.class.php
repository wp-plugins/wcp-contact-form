<?php

class SCFP_Settings extends Agp_Module {

    private $config;
    
    private $errorConfig;
    
    private $form;

    private $error;
    
    private $notification;

    private $formKey = 'scfp_form_settings';

    private $errorKey = 'scfp_error_settings';
    
    private $notificationKey = 'scfp_notification_settings';
    
    private $pluginOptionsKey = 'scfp_plugin_options';
    
    private $pluginSettingsTabs = array();    
    
    
    /**
     * @var object The single instance of the class 
     */
    protected static $_instance = null;    
    
	/**
	 * Main Instance
	 *
     * @return Visualizer
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}    
    
	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
    }        
    
    public function __construct($baseDir) {
        parent::__construct($baseDir);        
        
        $this->config = include_once ($this->getBaseDir() . '/config/field-settings-config.php');
        $this->errorConfig = include_once ($this->getBaseDir() . '/config/error-config.php');
        
        add_action( 'init', array( $this, 'loadSettings' ) );
        add_action( 'admin_init', array( $this, 'registerSettings' ) );
        add_action( 'admin_menu', array( $this, 'adminMenu' ) );   
        add_action( 'admin_notices', array( $this, 'customAdminNotices' ) );         
        //add_filter( 'parent_file', array($this, 'currentMenu') );        
    }
    
    function loadSettings() {
       
        //create arrays with all values from every option
        $this->form = (array) get_option( $this->formKey );
        $this->error = (array) get_option( $this->errorKey );
        $this->notification = (array) get_option( $this->notificationKey );

        $config = $this->getConfig();
      
        foreach( $config['rows'] as $config_key => $config_value ):
            $field_settings_default[$config_key] = $config_value['default']; 
        endforeach;
        
        $error_config = $this->getErrorConfig();
        
        foreach( $error_config as $error_config_key => $error_config_value ):
            $error_default[$error_config_key] = $error_config_value['text']; 
        endforeach;

        // Merge with defaults
        // add defolt values to option fields
        $this->form = array_merge( array(
            'button_name' => 'Send',
            'button_color' => '#404040',
            'text_color' => '#FFF',            
            'field_settings' => $field_settings_default,
            'page_name' => '',
            'html5_enabled' => '',
        ), $this->form );
        
        //CODEHACK
        if (empty($this->form['field_settings']['captcha']) && !empty($field_settings_default['captcha'])) {
            $this->form['field_settings']['captcha'] = $field_settings_default['captcha'];
        }
        
        $this->error = array_merge( array(
            'error_name' => $error_default
        ), $this->error );

        $this->notification = array_merge( array(
            'another_email' => '',
            'subject' => 'New submission from contact form',
            'message' => "Dear {\$admin_name},\nYou got a new message from contact form!\n\nForm message:\n{\$data}",
            'user_subject' => 'Form submission confirmation',
            'user_message' => "Dear {\$user_name},\nThanks for contacting us!\nWe will get in touch with you shortly.\n\nYour message:\n{\$data}"            
        ), $this->notification );
    }    

    public function registerSettings () {
        
        //create array with names of tabs; use it in 'settings.php' template
        $this->pluginSettingsTabs[$this->formKey] = 'Form';
        $this->pluginSettingsTabs[$this->errorKey] = 'Errors';
        $this->pluginSettingsTabs[$this->notificationKey] = 'Notifications';
        
        
        //register 3 options
        register_setting( $this->formKey, $this->formKey ); 
        register_setting( $this->errorKey, $this->errorKey );        
        register_setting( $this->notificationKey, $this->notificationKey ); 
        
        global $pagenow;
        if($pagenow == 'admin.php' && !empty($_REQUEST['page']) && $_REQUEST['page'] == $this->pluginOptionsKey && !empty($_REQUEST['reset-settings'])) {
            $this->resetSettings();
            wp_redirect(add_query_arg(array('is-reset-form' => 'true'), remove_query_arg('reset-settings')));
        }        
    }
    
    public function adminMenu () {
        add_menu_page('Contact Form', 'Contact Form', 'manage_options', 'scfp');            
        add_submenu_page('scfp', 'Settings', 'Settings', 'manage_options', $this->pluginOptionsKey, array($this, 'renderSettingsPage'));                
    }

    function currentMenu($parent_file){
        global $submenu_file, $pagenow;
        
        //TODO: ....
        if($pagenow == 'admin.php' && !empty($_REQUEST['page']) && $_REQUEST['page'] == 'view-entry') {
            //$submenu_file = 'admin.php?page=scfp_plugin_options';
            //$parent_file = 'edit.php?post_type=form-entries';
        }

        return $parent_file;

    }        

    public function renderSettingsPage () {
        echo $this->getTemplate('admin/settings');                    
    }        
    
    public function getOptions() {
        return array(
            'form' => $this->getForm(),
            'error' => $this->getError(),
            'notification' => $this->getNotification(),
        );
    }
    
    public function resetSettings () {
        delete_option( $this->formKey );
        delete_option( $this->errorKey );
        delete_option( $this->notificationKey );                
    }

    public function getForm() {
        return $this->form;
    }

    public function getError() {
        return $this->error;
    }

    public function getNotification() {
        return $this->notification;
    }

    public function getFormKey() {
        return $this->formKey;
    }

    public function getErrorKey() {
        return $this->errorKey;
    }

    public function getNotificationKey() {
        return $this->notificationKey;
    }

    public function getPluginOptionsKey() {
        return $this->pluginOptionsKey;
    }

    public function getPluginSettingsTabs() {
        return $this->pluginSettingsTabs;
    }

    public function getConfig() {
        return $this->config;
    }
    public function getErrorConfig() {
        return $this->errorConfig;
    }

    public function customAdminNotices() {

        global $pagenow;

        if ( $pagenow == 'admin.php' && isset($_REQUEST['is-reset-form']) && !isset($_REQUEST['settings-updated'])) {
            $message = 'Settings reset to default values';
            echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>'.$message.'</strong></p></div>';            
        }
    }            
}

