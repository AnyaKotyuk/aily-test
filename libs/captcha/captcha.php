<?php
session_start();
$string = "";
for ($i = 0; $i < 2; $i++) {
	$string .= chr(rand(48, 57));
	$string .= chr(rand(97, 122));
}
$_SESSION['rand_code'] = $string;
$dir = "fonts/";
$image = imagecreatetruecolor(100, 34);
$black = imagecolorallocate($image, 10, 110, 0);
$color = imagecolorallocate($image, 200, 180, 90);
$bg = imagecolorallocate($image, 255, 255, 0);
imagefilledrectangle($image,0,0,399,99,$bg);
imagettftext ($image, 20, 0, 10, 28, $color, $dir."verdana.ttf", $_SESSION['rand_code']);
header("Content-type: image/png");
imagepng($image);