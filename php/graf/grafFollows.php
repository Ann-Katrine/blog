<?php
	include_once('../db.php');

	$DB = new DB();

	// Create GD Image
	$img = imagecreatetruecolor(800, 350);

	// Assign Some "color?"
	$black = imagecolorallocate($img, 0, 0, 0);
	$while = imagecolorallocate($img, 255, 255, 255);
	$red = imagecolorallocate($img, 255, 153, 153);

	// text
	$text = "-1";
	$size = "36";
	$font = "./arial.ttf";

	// Set background colour to white
	imagefill($img, 0, 0, $while);

	$howMantFollows = $DB->conn->query("SELECT COUNT(Follows.idFollows) AS NUM FROM Follows");
	$howMany = mysqli_fetch_assoc($howMantFollows)["num"];

	// antal fra de forskellige skostørrelser
	$x = 40;
	$y = 90;
	$tal = 55;
	for($i = 1; $i < ($howMany + 1); $i++){
		get_follows_value($i, $x, $y, $black, $black, $red, $img, $font, $size++, $tal, $DB->conn);
		$x += 70;
		$y += 70;
		$tal += 70;
	}

	function get_follows_value($dato, $x, $y, $bg, $fg, $img, $font, $size, $tal, $DB) {
		$getDato = $DB->conn->query("SELECT COUNT(Follows.dato) AS NUM FROM Follows WHERE Follows.dato = ".$dato);
		$getTheDato = mysqli_fetch_assoc($getDato)["num"];

		imagefilledrectangle($img, $x, 320, $y, 320-($getTheDato), $fg);
		imagerectangle($img, $x, 320, $y, 320-($getTheDato), $bg);
		imagettftext($img, 13, 0, $tal, 340, $bg, $font, ($size)); // text hen ad x-aksen
	}

	// Draw x-axis
	$in = 1;
	for($i = 0; $i <= 8; $i += 1){
		if($i < 1){
			$in += 1;
		}
		imageline($img, 20, 390-(35 * $in), 790, 390-(35 * $in), $black);
		imagettftext($img, 13, 0, 3, 394-(35 * $in), $black, $font, ($text += 1)); // text ned ad y-aksen
		$in += 1;
	}

	// Draw y-aksen
	imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

	// Define output header
	header('Content-type: image/png');

	// Output the png image
	imagepng($img);

	// Destroy GD image
	imagedestroy($img);
?>
