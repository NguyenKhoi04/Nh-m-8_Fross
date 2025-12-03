<?php
session_start();
ob_clean(); // Xóa mọi output rác

header("Content-Type: image/png");

// Tạo mã captcha gồm 5 ký tự
$captcha = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
$_SESSION["captcha"] = $captcha;

// Tạo ảnh
$img = imagecreatetruecolor(150, 50);

$bg  = imagecolorallocate($img, 255, 255, 255);
$txt = imagecolorallocate($img, 0, 0, 0);

// Nền
imagefilledrectangle($img, 0, 0, 150, 50, $bg);

// Vẽ chữ
imagestring($img, 5, 40, 15, $captcha, $txt);

// Nhiễu
for ($i = 0; $i < 100; $i++) {
    imagesetpixel($img, rand(0,150), rand(0,50), $txt);
}

imagepng($img);
imagedestroy($img);
?>