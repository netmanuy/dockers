<?php

// Set Timer 
$timer_min=0;
$timer_max=59;

// Create statics images to build timer
for ($i = $timer_min; $i <= $timer_max; $i++){

    // Add extra zero if needed
    if ($i < 10) {
        $text_timer = sprintf("%02d", $i);
    } else { 
        $text_timer = $i;
    }

    // Create a new Image
    $canvas = new Imagick();

    // Set image background and size
    $canvas->newImage(70, 70, "white");

    // Set Imagick Draw for texts
    $draw = new ImagickDraw();

    // Center Text
    $draw->setGravity (Imagick::GRAVITY_CENTER);

    // Set font size
    $draw->setFontSize(24);

    // Set font type
    $draw->setFont('testing_arialbd.ttf');

    // Set text
    $text_to_right = $text_timer;

    // Set text color
    $draw->setFillColor("rgb(0,0,0)"); //set text color

    // Draw images on canvas
    $canvas->annotateImage($draw, 0, 0, 0, $text_to_right);

    // Set Image format
    $canvas->setImageFormat ("png");

    // Save file 
    file_put_contents ("tmp/image" . $text_timer . ".png", $canvas); 
}

// Create GIF image and Frame
$GIF = new Imagick();
$frame = new Imagick();
$GIF->setFormat("gif");

// Simple image setup
$image_folder = "tmp/";
$image_delay = 100;

// Open Folder
$handle_folder = opendir($image_folder);

// Read files from Image folder
while (false !== ($filename = readdir($handle_folder))) {
    if ($filename != "." && $filename != "..") {
        // Add  images into array
        $image_files[] = $filename;
    }
}

// Order array on revert file 
rsort($image_files);

// Build gif reading each images
foreach ($image_files as $filename) {
    // Add images frame
    $frame->readImage($image_folder . $filename);

    // Delete temporal image
    unlink($image_folder . $filename);

    // Adding Delay
    $frame->setImageDelay($image_delay);
}

// Add images and build Gif
$GIF->addImage($frame);

// Set Gif Header 
header("Content-Type: image/gif");

// Output gif into browser
echo $GIF->getImagesBlob();
?>