<?php

// Draw text if we can read by GET or draw default text
if(isset($_GET['text'])) {
    $text_to_right = $_GET['text'];
} else {
    $text_to_right = "Testing Images..";
}

// Create a new Image
$canvas = new Imagick();

// Set canvas size and background
$canvas->newImage(400, 70, "white");

// Set Imagick object for draw
$draw = new ImagickDraw();

// Center text 
$draw->setGravity (Imagick::GRAVITY_CENTER);

// Set font size
$draw->setFontSize(24);

// Set font type
$draw->setFont('testing_arialbd.ttf');

// Draw shadow 
//$draw->setFillColor("rgb(132,132,132)"); //set shadow color
//$canvas->annotateImage($draw, 0 + 1, 0 + 1, 0, $text_to_right); 

// Set  text color
$draw->setFillColor("rgb(0,0,0)"); //set text color

// Draw original text 
$canvas->annotateImage($draw, 0, 0, 0, $text_to_right);

// Set Image type 
$canvas->setImageFormat('png');

// Set Image header 
header("Content-Type: image/png");

// Print image
echo $canvas;
?>
