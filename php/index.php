<?php
	// Inkluderer alle de nødvendige filer.
	include('class_bolgpost.php');
	include("class_billeder.php");
	include('Route.php');

include_once("./class_follows.php");


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
/*              henter et indlæg                */
/************************************************/
	Route::add('/post/onePost/([0-9]*)', function($id){
		$blogPosts = new blogposts();

		$result = $blogPosts->getOnePostById($id);
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

/************************************************/
/*                     login                    */
/************************************************/
	Route::add('/login', function(){
		//$data = json_decode(file_get_contents("php://input"), true);
		/*var_dump($data);
		exit(0);*/
		$Brugernavn = $_POST["brugernavn"];
		$Password = $_POST["password"];
		
		if(!empty($Brugernavn) && !empty($Password)){
			$followship = new followship();
			
			$followship->getFollowship($Brugernavn, $Password);
			echo "virker";
		}
	}, "post");

/************************************************/
/*           opretter ny followship            */
/************************************************/
	Route::add('/followship', function(){
		// Henter JSON fra en "fil" der ikke eksisterer, men får det hele til at cirker?!
		$data = json_decode(file_get_contents("php://input"), true);

		// Formaterer centent som JSON
		$Name = $data["name"];
		$Mail = $data["email"];
		$Brugernavn = $data["username"];
		$Password = $data["password"];


		// Tjekker om variablerne er tomme
		if(!empty($Name) && !empty($Mail) && !empty($Brugernavn) && !empty($Password)){
			$followship = new followship();

			$followship->createFollowship($Name, $Mail, $Brugernavn, $Password, 2);
			echo "oprettet";
		}
	}, "post");

/************************************************/
/*                  follow graf                 */ // ikke færdig
/************************************************/
	Route::add('/post/follows/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))', function($date1){


		$dates = explode("/", $date1);

		$d1 = $dates[0];
		$d2 = $dates[1];

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

		//tekst og data til graf
		$font = "/home/sebathefox/domains/ak.sebathefox.dk/public_html/php/graf/arial.ttf";
		$tal = 7; // længden af arrayet
		$hej = []; // til at spilte datoen op man vælger
		$day = []; // bruges sammen med arrayet hej til at tælle dagene op
		$zero = ["0", "-"]; // til at få det rigtige day og dato
		$x_akseTal = 35;
		$antalReadI = array_values($followship->getFollowsByWeek($d1));
		$string = $antalReadI[0]["dato"];
		$hej = explode("-", $string);

		/*var_dump($hej);
		exist(0);*/

		for($i = 0; $i < $tal; $i++){
			$day[$i] = $hej[2]+$i;	// gør at dagene tæller op
			$day[$i] = $zero[0].$day[$i]; // punktum gør at de kan sættes ved siden af hinaden og der kommer til at stå 0 foran
			$day[$i] = $hej[0].$zero[1].$hej[1].$zero[1].$day[$i]; // gør at vi får en dato med år måned og dag sat sammen igen
			imagettftext($img, 10, 330, $x_akseTal, 334, $black, $font, $day[$i]); // får det skriv ud på skærmen
			$x_akseTal =$x_akseTal+40; // at tekst rykker hen
			$antalRead = array_values($followship->getFollowsByWeek($day[$i]));
			imagefilledrectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-(count($antalRead) * 10), $red);
			imagerectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-(count($antalRead) * 10), $black);
		}


		/*for($i = 0; $i < count($antalRead); $i++){
			imagefilledrectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-(count($antalRead) * 10), $red);
			imagerectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-(count($antalRead) * 10), $black);
        }*/

		/*$antalDato = $followship->countHowManyFollowsOnAMonth($d1, $d2);
		$datoRead = array_values($followship->getDatoFromToDato($d1, $d2));
		$x_akseTal = 35;
		for($i = 0; $i <= $antalDato; $i++){
			imagettftext($img, 10, 330, $x_akseTal, 334, $black, $font, $datoRead[$i]["dato"]);
			$x_akseTal = $x_akseTal + 40;
		}*/

		// laver x-axis
		imageline($img, 20, 320, 320, 320, $black); // x-akse 20 står på linje, 320 skal være det samme som nr. 4-tal, 320 længden på linjen, 320 skal være det samme som nr 2-tal. nr 2 og 4 tal er hvor linjen befinder sig.

		// laver y-axis
		imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

		// test til tekst

		//$in = 5;
		$tal = 28;
		$linje = 310;
		for($i = 0; $i <= $tal; $i++){
			imageline($img, 20, $linje, 320, $linje, $black);
			$linje = $linje - 10;
		}
		imagettftext($img, 10, 360, 7, 274, $black, $font, "5"); // for at få tekst. 10 er størrelse, 360 er balacen for tallet, 274 y-aske, 7 x-akse
		imagettftext($img, 10, 360, 3, 224, $black, $font, "10");
		imagettftext($img, 10, 360, 3, 174, $black, $font, "15");
		imagettftext($img, 10, 360, 3, 124, $black, $font, "20");
		imagettftext($img, 10, 360, 3, 74, $black, $font, "25");

		// sætter header til PNG
		header('Content-Type: image/png');

		// Output the png image
		imagepng($img);

		// ødlæger GD billed
		imagedestroy($img);
	});

/************************************************/
/*             number read graf                 */ // ikke færdig
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

		$font = "/home/sebathefox/domains/ak.sebathefox.dk/public_html/php/graf/arial.ttf";
		$x_akseTal = 35;
		$antalRead = array_values($statiker->getStatikPrDag($id));
		for($i = 0; $i <= count($antalRead); $i++){

			imagefilledrectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-($antalRead[$i]["number_Read"] * 10), $red);
			imagerectangle($img, $i * 40 + 25, 320, $i * 40 + 60, 320-($antalRead[$i]["number_Read"] * 10), $black);
        }

		$antalDato = $statiker->countHowManyDatoOnOnePost($id);
		$datoRead = array_values($statiker->getDatoPrDag($id));
		for($i = 0; $i <= $antalDato; $i++){
			imagettftext($img, 10, 330, $x_akseTal, 334, $black, $font, $datoRead[$i]["dato"]);
			$x_akseTal = $x_akseTal + 40;
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

		// tekst på y-aksesn
		$tal = 28;
		$linje = 310;
		for($i = 0; $i <= $tal; $i++){
			imageline($img, 20, $linje, 320, $linje, $black);
			$linje = $linje - 10;
		}
		imagettftext($img, 10, 360, 7, 274, $black, $font, "5"); // for at få tekst. 10 er størrelse, 360 er balacen for tallet, 274 y-aske, 7 x-akse
		imagettftext($img, 10, 360, 3, 224, $black, $font, "10");
		imagettftext($img, 10, 360, 3, 174, $black, $font, "15");
		imagettftext($img, 10, 360, 3, 124, $black, $font, "20");
		imagettftext($img, 10, 360, 3, 74, $black, $font, "25");

		// tekst på x-aksen
		//imagettftext($img, 10, 330, 35, 334, $black, $font, "god dag var");
		//imagettftext($img, 10, 330, 75, 334, $black, $font, "god dag var");

		// sætter header til PNG
		header('Content-Type: image/png');

		// Output the png image
		imagepng($img);

		// ødlæger GD billed
		imagedestroy($img);

	});

	// Starter Routing.
	Route::run('/php');
?>
