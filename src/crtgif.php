<?php

// Create GIF image and Frame
$GIF = new Imagick();
$frame = new Imagick();
$GIF->setFormat("gif");

// Simple image setup
$image_folder = "img/";
$image_delay = 100;

// Open Folder
$handle_folder = opendir($image_folder);

// Read files from Image folder
while (false !== ($filename = readdir($handle_folder))) {
    if ($filename != "." && $filename != "..") {
        
        // Add  images into array just for debug in case if needed
        $image_files[] = $filename;

        // Add images frame
        $frame->readImage($image_folder . $filename);

        // Adding Delay
        $frame->setImageDelay($image_delay);
    }
}

// Add images and build Gif
$GIF->addImage($frame);

// Set Gif Header 
header("Content-Type: image/gif");

// Echo Gif into browser
echo $GIF->getImagesBlob();

?>