<?php

/*
 * 
 */
class C_FlickrManager extends C_ModuleManager
{
	/*
	 * 
	 */
	protected static $_instance;
	
	
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
	   		self::$_instance = new C_FlickrManager();
	   	}
	   	return self::$_instance;
	   	
    }//end getInstance()
		
    /*
     *
    */
    public function search()
    {
    	$filter = array(
    						'search' => FILTER_SANITIZE_STRING,
    						'page' => FILTER_VALIDATE_INT,
    						'per_page' => FILTER_VALIDATE_INT,
    						'license' => array('filter' => FILTER_VALIDATE_INT, 
    												  'flags' => FILTER_REQUIRE_ARRAY),
    						);
    	$qParams = filter_input_array(INPUT_GET, $filter);

    	 if (empty($qParams['search']) === true) {
    	 	throw new Exception('Expected search parameter missing');
    	 }
    	 $search = $qParams['search'];

    	 if (empty($qParams['license']) === true) {
    	 	throw new Exception('Atleast one license must be selected');
    	 }
    	 $license = implode(',', $qParams['license']);
    	 
    	 $page = ($qParams['page'] !== null) ? (int) $qParams['page'] : 1 ;

    	 $perPage = $qParams['per_page'];
    	 
    	$params = array(
    			'method'	=> 'flickr.photos.search',
    			'text'	    => $search,
    			'per_page'	=> $perPage,
    			'page'   	=> $page,
    			'sort'   	=> 'relevance',
    			'license ' => $license,
    	);
    	
    	$response = $this->_callFlickr($params);
    	   
    	if ($response['stat'] !== 'ok') {
    		throw new Exception('API Error');
    	}
    	
    	$photos = $response['photos']['photo'];
    	//Now, get URLs for the thumbnail and maximum size for each of the photos 
    	$images = array();
    	$i=0;
    	foreach ($photos as $photo){
    		
    		$farmID = $photo['farm'];
    		$userID = $photo['owner'];
    		$serverID = $photo['server'];
    		$photoID = $photo['id'];
    		$secret = $photo['secret'];
    		
    		$thumbnail = 'http://farm'.$farmID.'.staticflickr.com/'.$serverID.'/'.$photoID.'_'.$secret.'_t.jpg';
			$images[$i]['thumbnail'] = $thumbnail;
			$url = 'http://www.flickr.com/photos/'.$userID.'/'.$photoID.'/';
    		$images[$i]['photo'] = $photo;
    		
    		$i++;
    	}
    	
    	$license = '';
    	foreach ($qParams['license'] as $lic) {
    		$license .= '&license[]='.$lic;
    	}
    	$smarty = C_Smarty::getSmarty();
    	$smarty->assign('search',$search);
    	$smarty->assign('images',$images);
    	$smarty->assign('prevPage',$page-1);
    	$smarty->assign('nextPage',$page+1);
    	$smarty->assign('license',$license);
    	$smarty->assign('perPage',$perPage);
    	$smarty->setTemplate('flickr/search.tpl');
    	 
    }//end search()
    
    
    /*
     * 
     */
    public function licenses()
    {
    	$params = array(
    			'method'	=> 'flickr.photos.licenses.getInfo',
    	);
    	
    	$response = $this->_callFlickr($params);
    	var_dump($response['licenses']['license']);
    	 
    }

    /*
     * 
     */
    public function display()
    {
//     	var_dump($_GET);
    	
    	$filter = array(
    						'owner' => FILTER_SANITIZE_STRING,
	    					'id' => FILTER_SANITIZE_STRING,
	    					'farm' => FILTER_VALIDATE_INT,
		    				'server' => FILTER_VALIDATE_INT,
		    				'secret' => FILTER_SANITIZE_STRING,
    						'size' => FILTER_SANITIZE_STRING,
    			);
    	$photo = filter_input_array(INPUT_GET, $filter);
    	
//     	var_dump($photo);
    	
    	if (empty($photo['size']) === true) {
    		$photo['size'] = 'n';
    	}
    	
    	$img = 'http://farm'.$photo['farm'].'.staticflickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_'.$photo['size'].'.jpg';
    	
    	 
    	$options = array (    	's' => 'Small Square 75x75', 
									    	'q' => 'Large Square 150x150', 
									    	't' => 'Thumbnail, 100 on longest side', 
									    	'm' => 'Small, 240 on longest side', 
									    	'n' => 'Small, 320 on longest side', 
									    	'z' => 'Medium 640 on longest side', 
									    	'c' => 'Medium 800 on longest side', 
									    	'b' => 'Large, 1024 on longest side', 
									    	);
    	
    	$selected = $photo['size'];
    	
    	$smarty = C_Smarty::getSmarty();
    	$smarty->assign('img',$img);
    	$smarty->assign('photo',$photo);
    	$smarty->assign('options',$options);
    	$smarty->assign('selected',$selected);
    	$smarty->setTemplate('flickr/display.tpl');
    	 
    }
	/*
	 * 
	 */
    private function _callFlickr($params)
    {    
    	$defaultParams = array(
    				'api_key' => C_FLICKR_API_KEY,
    				'format'	=> 'php_serial',
    			);
		
    	$params = array_merge($defaultParams,$params); 
    	
	    $encodedParams = array();
	    foreach ($params as $k => $v){
	    	$encodedParams[] = urlencode($k).'='.urlencode($v);
	    }
	    
	     
	    $request= C_FLICKR_API_ENDPOINT.implode('&', $encodedParams);
	    $response = unserialize(file_get_contents($request));

	    return $response;

    }//end _callFlickr()
	
}//end class
?>