<?php
// READ FILES FROM THE GALLERY FOLDER
$dir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR;
$images = glob($dir . "*.{jpg,jpeg,gif,png}", GLOB_BRACE);

// DRAW HTML ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Very Simple PHP gallery</title>
    <link href="1-basic.css" rel="stylesheet">
  </head>
  <body>
    <!-- [THE GALLERY] -->
    <div id="gallery"><?php
    foreach ($images as $i) {
      printf("<img src='gallery/%s'/>", basename($i));
    }
    ?></div>
  </body>
</html>