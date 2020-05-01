<?php
	include('class_bolgpost.php');
	include('Route.php');

	// Add base route (startpage)
	Route::add('/', function(){
		echo 'welcome :-)';
	});

	// Simple test route that simulates static html file
	Route::add('test.html', function(){
		echo 'Hello from test.html';
	});

	// Post route example
	Route::add('/contact-form', function(){
		echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
	},'get');

	// Post route example
	Route::add('/contact-form', function(){
		echo 'Hey! The form has been sent:<br/>';
		print_r($_POST);
	}, 'post');

	// Accept only numbers as parameter. other characters will result in a 404 error
	Route::add('/foo/([0-9]*)/bar', function($var1){
		echo $var1. ' is a great number!';
	});

	Route::add('/posts', function(){
		$blogPosts = new blogPosts();

		$result = $blogPosts->getAllPosts();
		echo json_encode($result);
	}, "get");

	Route::add('/posts', function(){

		if(isset($_POST["content"]) && isset($_POST["location"]) && isset($_POST["title"])){
			$tekst = $_POST["content"];
			$sted = $_POST["location"];
			$title = $_POST["title"];
			$dato = date("Y-m-d");
			if(!empty($tekst) && !empty($sted) && !empty($title) && !empty($dato)){
				$blogPosts = new blogPosts();

				$blogPosts->createPosts($tekst, $sted, $title, $dato);
				echo "oprettet";
			}
		}
	}, "post");

	Route::run('/php');
?>
