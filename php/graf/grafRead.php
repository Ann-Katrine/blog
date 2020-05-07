<?php
	include("../class_statik.php");

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
	- for være værdi vil man add 35px
	- alle graffer vil være 50px bred
	- vi sætter 20px mellemrum mellem være bjælke
	- på grund af der bliver minus med 320 er på grund af ellers står de løftet
	*/

	$statiker = new statiker();

	$antal = $statiker->countHowManyReadOnOnePost($id);

	for($i = 0; $i <= $antal; $i++){
		$antalRead = $statiker->getStatikPrDag($id);
		imagefilledrectangle($img, 40, 320, 90, 320-($antalRead*35), $red);
		imagerectangle($img, 40, 320, 90, 320-($antalRead*35), $black);

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
	imagettftext($img, 10, 360, 7, 274, $black, $font, $in); // for at få tekst. 20 er størrelse, 350 er balacen for tallet, 210 y-aske, 200 x-akse

	// sætter header til PNG
	header('Content-Type: image/png');

	// Output the png image
	imagepng($img);

	// ødlæger GD billed
	imagedestroy($img);
?>
