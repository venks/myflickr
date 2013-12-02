<?php
/*
 * 
 */

class C_HomeManager extends C_ModuleManager
{
	/*
	 * 
	 */
	private static $_instance;
	
	/*
	 * 
	 */
	private function __construct(){

	}
	
   /*
    * 
    */
	public static function getInstance()
    {
 	  	if (isset(self::$_instance) === false) {
	   		self::$_instance = new C_HomeManager();
	   	}
	   	return self::$_instance;
	   	
    }//end getInstance()
	
	/*
	 * 
	 */
	public function display(){
		
		$smarty = C_Smarty::getSmarty();
		$smarty->setTemplate('home/index.tpl');
		
	}//end display()


}//end class