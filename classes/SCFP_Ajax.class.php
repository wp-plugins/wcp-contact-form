<?php

class SCFP_Ajax extends Agp_AjaxAbstract {
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
    
    
    /**
     * Refresh Captcha Action
     */
    public function recreateCaptcha($data) {
        $id = $data['id'];
        $form = new SCFP_Form($id);
        $atts['id'] = $id;
        $atts['form'] = $form;
        return SCFP()->getTemplate('scfp', $atts);                
    }
}
