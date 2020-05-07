<?php
	// Inkluderer alle de nødvendige filer.
	include('class_bolgpost.php');
	include("class_billeder.php");
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

	// Henter alle indlæg fra databasen.
	Route::add('/posts', function(){
		$blogPosts = new blogPosts();

		$result = $blogPosts->getAllPosts();
		echo json_encode($result);
	}, "get");

	// Opretter et nyt indlæg.
	Route::add('/posts', function(){

		/*******************************/
		/*				MAGI		   */
		/*******************************/
		// henter JSON fra en "fil" der ikke eksisterer, men får det hele til at virke?!
		$data = json_decode(file_get_contents("php://input"), true);


		// Formaterer content som JSON.
		$tekst = json_encode($data["content"]);
		$sted = $data["location"];
		$title = $data["title"];
		$dato = date("Y-m-d"); // Laver en ny dato.

		// Tjekker om variablerne er tomme.
		if(!empty($tekst) && !empty($sted) && !empty($title) && !empty($dato)){
			$blogPosts = new blogPosts();

			// Opretter indlægget i databasen gennem et "Repository" (Spørg Sebastian for mere information)
			$blogPosts->createPosts($tekst, $sted, $title, $dato);
			echo "oprettet";
		}
	}, "post");

	// Tilføjer et nyt billede til serveren.
	Route::add('/billed', function(){

		// Lav et byt billed.
		$billed = new billed();

		// Opret.
		// Send null fordi vi får dataen fra billedet.
		echo $billed->createBillede(null);
	}, "post");

	Route::add("/graf/grafFollows.php", function () {
		// Kører koden i grafFollows.php
		include_once "./graf/grafFollows.php";
	});

	Route::add("/graf/grafRead.php", function () {
		// Kører koden i grafRead.php
		include_once "./graf/grafRead.php";
	});

	// Starter Routing.
	Route::run('/php');
?>
