<?php
	// viser alle fejl fra php filen
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	include_once('./class_bolgpost.php');

	/*switch(){
		case 1:
			break;
	}*/
		
		
	if(!isset($_GET["posts"])){
		exit(1);	
	}

	switch($_GET["posts"]){
		case 'getallpost':
			$blogPosts = new blogPosts();

			$result = $blogPosts->getAllPosts();
			echo json_encode($result);  
			break;
	}
	

	/*$blogPosts = new blogPosts();

	$result = $blogPosts->getAllPosts();
	echo json_encode($result);*/  
?>
