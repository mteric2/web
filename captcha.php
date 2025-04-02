<?php
session_start();
$captcha = rand(1000, 9999);
$_SESSION['captcha'] = $captcha;

header("Content-type: image/png");
$img = imagecreate(80, 30);
$bg = imagecolorallocate($img, 255, 255, 255);
$text_color = imagecolorallocate($img, 0, 0, 0);
imagestring($img, 5, 20, 5, $captcha, $text_color);
imagepng($img);
imagedestroy($img);
?>
