<?php
use Webcodin\WCPContactForm\Core\Agp_AjaxAbstract;

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
        $key = $data['key'];        
        
        $form = new SCFP_Form($id);
        $fieldsSettings = SCFP()->getSettings()->getFieldsSettings();
        $field = $fieldsSettings[$key];
        $formSettings = SCFP()->getSettings()->getFormSettings();
        $formData = $form->getData();    
        
        $atts['id'] = $id;
        $atts['form'] = $form;
        $atts['key'] = $key;
        $atts['field'] = $field;
        $atts['formSettings'] = $formSettings;
        $atts['formData'] = $formData;
        
        return SCFP()->getTemplate('form/captcha', $atts);                
    }
}
