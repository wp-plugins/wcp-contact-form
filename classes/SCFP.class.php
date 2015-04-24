<?php

class SCFP extends Agp_Module {
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
        
        $this->settings = new SCFP_Settings($this->getBaseDir());
        $this->formEntries = new SCFP_FormEntries($this->getBaseDir());
        $this->session = Agp_Session::instance();
        $this->ajax = SCFP_Ajax::instance();
        
        add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts' ) );                
        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAdminScripts' ));            
        add_shortcode( 'scfp', array($this, 'doScfpShortcode') ); 
        add_action( 'widgets_init', array($this, 'initWidgets' ) );
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
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );            
        wp_enqueue_script( 'scfp', $this->getAssetUrl('js/admin.js'), array('jquery', 'wp-color-picker') );                                                         
        wp_enqueue_style( 'scfp-css', $this->getAssetUrl('css/admin.css'), array('wp-color-picker') );                    
    }
    
    public function doScfpShortcode ($atts) {
        $atts = shortcode_atts( array(
            'id' => NULL,
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

}