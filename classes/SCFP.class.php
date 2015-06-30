<?php
use Webcodin\WCPContactForm\Core\Agp_Module;
use Webcodin\WCPContactForm\Core\Agp_Session;

class SCFP extends Agp_Module {
    
    /**
     * Form Settings
     * 
     * @var SCFP_FormSettings
     */
    private $formSettings;    
    
    /**
     * Plugin settings
     * 
     * @var SCFP_Settings
     */
    private $settings;    
    
    
    /**
     * Session
     * 
     * @var Agp_Session
     */
    private $session;

    /**
     * Form entries
     * 
     * @var SCFP_FormEntries
     */
    private $formEntries;

    /**
     * Ajax
     * 
     * @var SCFP_Ajax 
     */
    private $ajax;
    
    /**
     * The single instance of the class 
     * 
     * @var object 
     */
    protected static $_instance = null;    
    
	/**
	 * Main Instance
	 *
     * @return object
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
    
    public function __construct() {
        parent::__construct(dirname(dirname(__FILE__)));
        
        include_once ( $this->getBaseDir() . '/types/form-entries-post-type.php' );     
        include_once ( $this->getBaseDir() . '/inc/cool-php-captcha/captcha.php' );     
        
        $this->settings = SCFP_Settings::instance( $this );
        $this->formSettings = SCFP_FormSettings::instance();        
        $this->formEntries = SCFP_FormEntries::instance();
        $this->session = Agp_Session::instance();
        $this->ajax = SCFP_Ajax::instance();
        
        
        add_action( 'init', array($this, 'init' ) );                
        add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts' ) );                
        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAdminScripts' ));            
        add_shortcode( 'scfp', array($this, 'doScfpShortcode') ); 
        add_shortcode( 'wcp_contactform', array($this, 'doScfpShortcode') ); 
        add_action( 'widgets_init', array($this, 'initWidgets' ) );
        add_action( 'admin_init', array($this, 'tinyMCEButtons' ) );        
    }
    
    public function init() {
        $this->settings->applyUpdateChanges();
    }
    
    public function initWidgets() {
        register_widget('SCFP_FormWidget');
    }
    
    public function enqueueScripts () {
        wp_enqueue_script( 'scfp', $this->getAssetUrl('js/main.js'), array('jquery') ); 
        
        wp_localize_script( 'scfp', 'ajax_scfp', array( 
            'base_url' => site_url(),         
            'ajax_url' => admin_url( 'admin-ajax.php' ), 
            'ajax_nonce' => wp_create_nonce('ajax_atf_nonce'),        
        ));  
        wp_enqueue_style( 'scfp-css', $this->getAssetUrl('css/style.css') );                    
    }        
    
    public function enqueueAdminScripts () {
        global $current_screen;
        
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );            
        wp_enqueue_script( 'scfp', $this->getAssetUrl('js/admin.js'), array('jquery', 'wp-color-picker') );                                                         
        wp_enqueue_style( 'scfp-css', $this->getAssetUrl('css/admin.css'), array('wp-color-picker') );   
        wp_localize_script('scfp', 'csvVar', array(
            'href' => add_query_arg(array('download_csv' => 1)),
            'active' =>  'form-entries' == $current_screen->post_type,
        ));
    }
    
    public function tinyMCEButtons () {
        
        $form_settings = $this->settings->getFormSettings();
        if ( current_user_can('edit_posts') && current_user_can('edit_pages') && !empty($form_settings['tinymce_button_enabled'])) {
            if ( get_user_option('rich_editing') == 'true' ) {
               add_filter( 'mce_buttons', array($this, 'tinyMCERegisterButtons'));                
               add_filter( 'mce_external_plugins', array($this, 'tinyMCEAddPlugin') );
            }        
        }        
    }
    
    public function tinyMCERegisterButtons( $buttons ) {
       array_push( $buttons, "|", "wcp_contactform" );
       return $buttons;
    }    
    
    public function tinyMCEAddPlugin( $plugin_array ) {
        $plugin_array['wcp_contactform'] = $this->getAssetUrl() . '/js/wcp-contactform.js';
        return $plugin_array;        
    }            
    
    public function doScfpShortcode ($atts) {
        $atts = shortcode_atts( array(
            'id' => 'default-contactform-id',
        ), $atts );        
        
        
        if (!empty($atts['id'])) {
            $id = $atts['id'];
            $form = new SCFP_Form($id);
            $form->submit($_POST);
            $atts['form'] = $form;
            return $this->getTemplate('scfp', $atts);                
        }
    }
    
    public function doContactFormWidget($atts){
        $atts = shortcode_atts( array(
            'id' => NULL,
        ), $atts );        
        
        
        if (!empty($atts['id'])) {
            $id = $atts['id'];
            $form = new SCFP_Form($id);
            $form->submit($_POST);
            $atts['form'] = $form;
            return $this->getTemplate('scfp-widget', $atts);                
        }    
    }
 
    public function getSettings() {
        return $this->settings;
    }

    function getFormEntries() {
        return $this->formEntries;
    }
    
    function getFormSettings() {
        return $this->formSettings;
    }    

}
