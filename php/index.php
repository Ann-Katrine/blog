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

/************************************************/
/*       Henter alle indlæg fra databasen.      */
/************************************************/
	Route::add('/posts', function(){
		$blogPosts = new blogPosts();

		$result = $blogPosts->getAllPosts();
		echo json_encode($result);
	}, "get");

/************************************************/
/*           Opretter et nyt indlæg.            */
/************************************************/
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

/************************************************/
/*      Tilføjer et nyt billede til serveren.   */
/************************************************/
	Route::add('/billed', function(){

		// Lav et byt billed.
		$billed = new billed();

		// Opret.
		// Send null fordi vi får dataen fra billedet.
		echo $billed->createBillede(null);
	}, "post");

	/*Route::add("/graf/grafFollows.php", function () {
		// Kører koden i grafFollows.php
		include_once "./graf/grafFollows.php";
	}); */

/************************************************/
/*                  follow graf                 */
/************************************************/
	Route::add('/post/follows/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))', function($date1){
		include_once("./class_follows.php");

		// Create GD Image
		// laver et tomt billed på størrelse med 600 * 450
		$img = imagecreatetruecolor(600, 450);

		// definer farver
		$black = imagecolorallocate($img, 0, 0, 0);
		$white = imagecolorallocate($img, 255, 255, 255);
		$red = imagecolorallocate($img, 155, 113, 150);

		// Sætter baggrunden til at være hvid
		imagefill($img, 0, 0, $white);

		// multiple rectangles
		/*
        - grafen vil være 400px bred, 350px høj
        - for være værdi vil man add 10px
        - alle graffer vil være 80px bred
        - vi sætter 20px mellemrum mellem være bjælke
        - på grund af der bliver minus med 320 er på grund af ellers står de løftet
        */

		$followship = new followship();

		$antal = $followship->getHowManyFollowsOnADay($date1);

		$antalRead = array_values($followship->getFollowsByDay($date1));
		for($i = 0; $i <= count($antalRead); $i++){

			imagefilledrectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-($antalRead[$i]["number_Read"] * 10), $red);
			imagerectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-($antalRead[$i]["number_Read"] * 10), $black);
        }

		// laver x-axis
		imageline($img, 20, 320, 320, 320, $black); // x-akse 20 står på linje, 320 skal være det samme som nr. 4-tal, 320 længden på linjen, 320 skal være det samme som nr 2-tal. nr 2 og 4 tal er hvor linjen befinder sig

		// laver y-axis
		imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

		// test til tekst
		$font = "/home/sebathefox/domains/ak.sebathefox.dk/public_html/php/graf/arial.ttf";
		$in = 5;
		$tal = 20;
		$linje = 310;
		for($i = 0; $i <= $tal; $i++){
			imageline($img, 20, $linje, 320, $linje, $black);
			$linje = $linje - 10;
			if($i == 5){
				imagettftext($img, 10, 360, 7, 274, $black, $font, $in); // for at få tekst. 20 er størrelse, 350 er balacen for tallet, 210 y-aske, 200 x-akse
			}
		}
		

		// sætter header til PNG
		header('Content-Type: image/png');

		// Output the png image
		imagepng($img);

		// ødlæger GD billed
		imagedestroy($img);
	});

/************************************************/
/*             number read graf                 */
/************************************************/
	Route::add('/post/read/([0-9]*)', function($id){
//		include_once("./graf/grafRead.php");
		include("./class_statik.php");

		// Create GD Image
		// laver et tomt billed på størrelse med 600 * 450
		$img = imagecreatetruecolor(600, 450);

		// definer farver
		$black = imagecolorallocate($img, 0, 0, 0);
		$white = imagecolorallocate($img, 255, 255, 255);
		$red = imagecolorallocate($img, 155, 113, 150);

		// Sætter baggrunden til at være hvid
		imagefill($img, 0, 0, $white);

		// multiple rectangles
		/*
        - grafen vil være 400px bred, 350px høj
        - for være værdi vil man add 10px
        - alle graffer vil være 80px bred
        - vi sætter 20px mellemrum mellem være bjælke
        - på grund af der bliver minus med 320 er på grund af ellers står de løftet
        */

		$statiker = new statiker();

		$antal = $statiker->countHowManyReadOnOnePost($id);
		/*$antalRead = $statiker->getStatikPrDag($id);
		for($i = 1; $i <= $antal; $i++){
			imagefilledrectangle($img, 40, 320, 80, 320-($antalRead*10), $red);
			imagerectangle($img, 40, 320, 80, 320-($antalRead*10), $black);
		}*/

		$antalRead = array_values($statiker->getStatikPrDag($id));
		for($i = 0; $i <= count($antalRead); $i++){

			imagefilledrectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-($antalRead[$i]["number_Read"] * 10), $red);
			imagerectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-($antalRead[$i]["number_Read"] * 10), $black);
        }

		/*// Cats: 6
        imagefilledrectangle($img, 40, 320, 90, 320-(6*35), $red);
        imagerectangle($img, 40, 320, 90, 320-(6*35), $black);

        // Dogs: 8
        imagefilledrectangle($img, 110, 320, 160, 320-(8*35), $red);
        imagerectangle($img, 110, 320, 160, 320-(8*35), $black);

        // Sheep: 3
        imagefilledrectangle($img, 180, 320, 230, 320-(3*35), $red);
        imagerectangle($img, 180, 320, 230, 320-(3*35), $black);

        // Whales: 8
        imagefilledrectangle($img, 250, 320, 300, 320-(8*35), $red);
        imagerectangle($img, 250, 320, 300, 320-(8*35), $black);
        */

		// laver x-axis
		imageline($img, 20, 320, 320, 320, $black); // x-akse 20 står på linje, 320 skal være det samme som nr. 4-tal, 320 længden på linjen, 320 skal være det samme som nr 2-tal. nr 2 og 4 tal er hvor linjen befinder sig

		// laver y-axis
		imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

		// test til tekst
		//$text = "1";
		$font = "/home/sebathefox/domains/ak.sebathefox.dk/public_html/php/graf/arial.ttf";
		$in = 5;
		imageline($img, 20, 310, 320, 310, $black);	//
		imageline($img, 20, 300, 320, 300, $black);
		imageline($img, 20, 290, 320, 290, $black);
		imageline($img, 20, 280, 320, 280, $black);
		imageline($img, 20, 270, 320, 270, $black);
		imageline($img, 20, 260, 320, 260, $black);
		imageline($img, 20, 250, 320, 250, $black);
		imageline($img, 20, 240, 320, 240, $black);
		imageline($img, 20, 230, 320, 230, $black);
		imageline($img, 20, 220, 320, 220, $black);
		imageline($img, 20, 210, 320, 210, $black);
		imagettftext($img, 10, 360, 7, 274, $black, $font, $in); // for at få tekst. 20 er størrelse, 350 er balacen for tallet, 210 y-aske, 200 x-akse

		// sætter header til PNG
		header('Content-Type: image/png');

		// Output the png image
		imagepng($img);

		// ødlæger GD billed
		imagedestroy($img);

	});

	/*Route::add("/graf/grafRead.php", function () {
		// Kører koden i grafRead.php
//		include_once "./graf/grafRead.php";
	});*/

	// Starter Routing.
	Route::run('/php');
?>
