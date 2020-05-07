<?php
// Create GD Image
// laver et tomt billed på størrelse med 200 * 150
$img = imagecreatetruecolor(600, 450);

// definer farver
$black = imagecolorallocate($img, 0, 0, 0);
$white = imagecolorallocate($img, 255, 255, 255);
$red = imagecolorallocate($img, 255, 153, 153);

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

// Cats: 6
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

// laver x-axis
imageline($img, 20, 320, 320, 320, $black);

// laver y-axis
imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

// test til tekst
$text = "-1";
$font = "/home/sebathefox/domains/ak.sebathefox.dk/public_html/php/graf/arial.ttf"; 
$in = "hej";
imageline($img, 40, 340, 40, 340-(8*35)-40, $black);  // y-akse
imageline($img, 20, 310, 320, 310, $black);	// x-akse 20 står på linje, 310 skal være det samme som nr. 4-tal, 320 længden på linjen, 310 skal være det samme som nr 2-tal. nr 2 og 4 tal er hvor linjen befinder sig
//imageline($img, 20, 290-(35 * $in), 790, 390-(35 * $in), $black);
imagettftext($img, 20, 315, 320, 315, $black, $font, $in);

// sætter header til PNG
header('Content-Type: image/png');
 
// Output the png image
imagepng($img);

// ødlæger GD billed
imagedestroy($img); 
?>