<?php

/*
 * 
 */
class C_MessageManager extends C_ModuleManager
{
	/*
	 * 
	 */
	protected static $_instance;
	
	/*
	 * 
	 */
	private $_messages = array();
	
	/*
	 * 
	 */
	public function __construct()
	{
		
	}//end __construct
	
	/*
	 * 
	 */
	public function init()
	{
		
	}//end _init()	
	
   /*
    * 
    */
	public static function getInstance()
    {
 	  	if (isset(self::$_instance) === false) {
	   		self::$_instance = new C_MessageManager();
	   	}
	   	return self::$_instance;
	   	
    }//end getInstance()
		
	/*
	 * 
	 */
	public function addInfoMessage($msg)
	{
		$this->_messages['info'][] = $msg;
	
	}//end addInfoMessage()
	
	/*
	 * 
	 */
	public function addErrorMessage($msg)
	{
		$this->_messages['error'][] = $msg;
	
	}//end addErrorMessage()
	
	/*
	 * 
	 */
	public function getMessages()
	{
		return $this->_messages;
			
	}//end getMessages()
	
}//end class
?>