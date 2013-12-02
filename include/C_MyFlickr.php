<?php
/*
 * 
 */

class C_MyFlickr
{
	/*
	 * 
	 */
	private $_smarty = NULL;


	/*
	 * 
	 */
	public function __construct(){
	
	}

	/*
	 * 
	 */
	public function init(){	

		//require_once 'C_Utility.php';
		
		$this->_initialiseConfig();
		
		$this->_initialiseModule('message');
		
		$this->_initialiseDisplay();
		
	}//end init()
	
	 /*
	 * 
	 */
	private function _initialiseConfig(){
		require_once __DIR__.'/../config/config.php';
	
		set_include_path(get_include_path().':'.C_INCLUDE_DIR.':'.C_MODULES_DIR);	
		
	}//end __initialiseConfig


	/*
	 * 
	 */
	private function _initialiseModule($module){
		$var = '_'.$module.'Manager';

		$this->$var = $this->getManager($module);
		
		$this->$var->init();

	}//end __initialiseUser
	
	/*
	 * 
	 */
	private function _initialiseDisplay(){

		require_once 'C_Smarty.php';
		
		$this->_smarty = C_Smarty::getSmarty();
		
	}//end __initialiseDisplay
	
	
	/*
	 * @access
	 * 
	 * @param
	 * 
	 * @return 
	 */
	public function route(){
		$segments = explode('/',$_SERVER['REQUEST_URI']);

		//Default Module, Action and Value
		$moduleName = 'home';
		$action = 'display';
		$value = null;
		
		if(empty($segments[1]) === false){
			$moduleName = $segments[1];
		}
		if(file_exists(C_MODULES_DIR.'/'.$moduleName.'/C_'.ucwords($moduleName).'Manager.php') === false){
			throw new Exception('Unidentified module: '.$moduleName);			
		}

		$manager = $this->getManager($moduleName);
		if (empty($segments[2]) === false) {
			$action = $segments[2];
			if (method_exists($manager, $action) === false){
				throw new Exception('Unidentified action: '.$action);
			}
			if (empty($segments[3]) === false){
				$value = $segments[3];
			}
		}
		//$this->_messageManager->addInfoMessage('calling '.$moduleName.'->'.$action.'()');
		$manager->$action($value);
				
	}//end route()

	/*
	 * 
	 */
	public static function getManager($moduleName)
	{
		require_once C_MODULES_DIR.'/C_ModuleManager.php';
		require_once C_MODULES_DIR.'/'.$moduleName.'/C_'.ucwords($moduleName).'Manager.php';
		$moduleClass = 'C_'.ucwords($moduleName).'Manager';
		
		$manager =  $moduleClass::getInstance();
		return $manager;

	}//end getManager()
	
	/*
	 * 
	 */
	public function error($e){
		//TODO: log to file and display generic error message

		$this->_messageManager->addErrorMessage($e->getMessage());
		$this->_smarty->assign('trace',$e->getTraceAsString());
		$this->_smarty->setTemplate('error.tpl');
		
	}//end error()
	
	/*
	 * 
	 */
	public function shutdown(){
		
		$messages = $this->_messageManager->getMessages();
		$this->_smarty->assign('messages',$messages);
		$this->_smarty->display($this->_smarty->getTemplate());
		exit();
	}

}//end class