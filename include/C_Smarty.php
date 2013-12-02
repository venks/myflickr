<?php

// load Smarty library
require C_LIB_DIR.'/third-party/smarty/Smarty.class.php';

class C_Smarty extends Smarty {

	/*
	 * 
	 */
	private static $_instance;
	
	/*
	 * 
	 */
	private $_template = C_SMARTY_TEMPLATE_DEFAULT;
	
   public function __construct()
   {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->template_dir = C_BASE_DIR.'/templates';
        $this->compile_dir  = C_BASE_DIR.'/tmp/templates_c/';
        $this->config_dir   = C_BASE_DIR.'/config/';
        $this->cache_dir    = C_BASE_DIR.'/tmp/cache/';

//        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->caching = C_SMARTY_CACHING;
   }
   
   /*
    * 
    */
   public static function getSmarty()
   {
   	if (isset(self::$_instance) === false) {
   		self::$_instance = new C_Smarty();
   	}
   	return self::$_instance;
   	
   }//end getSmarty()

  /*
   * 
   */
   public function setTemplate($template)
   {
   		$this->_template = $template;

   }//end setTemplate()

  /*
   * 
   */
   public function getTemplate()
   {
   		return $this->_template;

   }//end getTemplate()
   
}//end class
?>