<?php
	// viser alle fejl fra php filen
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	include_once('./class_bolgpost.php');

	$method = $_SERVER['REQUEST_METHOD'];

	switch($method){
		case 'GET':
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
			break;
		case 'POST':
			if(isset($_POST[""]) && isset($_POST[""]) && isset($_POST[""]) && isset($_POST[""]) && isset($_POST[""])){
				$tekst = $_POST[""]; 
				$sted = $_POST[""];
				$title = $_POST[""];
				$dato = $_POST[""];
				if(!empty($tekst) && !empty(sted) && !empty($title) && !empty($dato)){
					$blogPosts = new blogPosts();
					
					$CreatePosts = $blogPosts->createPosts();
					echo "oprettet";
				} 
			}
			break;
	}
?>
