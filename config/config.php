<?php
	define('C_BASE_DIR',__DIR__.'/..');
	define('C_BASE_URL',$_SERVER["HTTP_HOST"]);
	define('C_LIB_DIR',C_BASE_DIR.'/lib');
	define('C_INCLUDE_DIR',C_BASE_DIR.'/include');
	define('C_MODULES_DIR',C_BASE_DIR.'/modules');
	
	
	//define('C_SMARTY_CACHING','CACHING_LIFETIME_CURRENT');
	define('C_SMARTY_CACHING','CACHING_OFF');
	define('C_SMARTY_TEMPLATE_DEFAULT','home/index.tpl');
	
	define('C_FLICKR_API_ENDPOINT', 'http://api.flickr.com/services/rest/?');
	define('C_FLICKR_API_KEY', '40824a4a29eef84ee6091d00a5f431f7');
?>