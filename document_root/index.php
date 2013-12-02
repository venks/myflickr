<?php
	
	require __DIR__.'/../include/C_MyFlickr.php';
	
	try{
		$myFlickr = new C_MyFlickr();
		$myFlickr->init();
		$myFlickr->route();
	} catch (Exception $e){
		$myFlickr->error($e);
	}
	$myFlickr->shutdown();	
	
		
?>