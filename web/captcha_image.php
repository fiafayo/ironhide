<?php
// Font directory + font name
$font = 'fonts/flubber.ttf';
// Total number of lines
$lineCount = 40;
// Size of the font
$fontSize = 24;
// Height of the image
$height = 50;
// Width of the image
$width = 150;
$img_handle = imagecreate ($width, $height) or die ("Cannot Create image");
// Set the Background Color RGB
$backColor = imagecolorallocate($img_handle, 255, 255, 255);
// Set the Line Color RGB
$lineColor = imagecolorallocate($img_handle, 175, 238, 238);
// Set the Text Color RGB
//$txtColor = imagecolorallocate($img_handle, 135, 206, 235);
$txtColor = imagecolorallocate($img_handle, 0, 0, 235);
// Do not edit below this point
//$string = "abcdefghijklmnopqrstuvwxyz0123456789";
$string = "ABCDEFGHJKLMNPRSTUVWXYZ";
for($i=0;$i<5;$i++){
    $pos = rand(0,strlen($string)-1);
    $str .= $string{$pos};
}
$textbox = imagettfbbox($fontSize, 0, $font, $str) or die('Error in imagettfbbox function');
$x = ($width - $textbox[4])/2;
$y = ($height - $textbox[5])/2;
imagettftext($img_handle, $fontSize, 0, $x, $y, $txtColor, $font , $str) or die('Error in imagettftext function');
for($i=0;$i<$lineCount;$i++){
    $x1 = rand(0,$width);$x2 = rand(0,$width);
    $y1 = rand(0,$width);$y2 = rand(0,$width);
    imageline($img_handle,$x1,$y1,$x2,$y2,$lineColor);
}
header('Content-Type: image/jpeg');
imagejpeg($img_handle,NULL,100);
imagedestroy($img_handle);

session_start();
$_SESSION['img_secret'] = $str;
?>


