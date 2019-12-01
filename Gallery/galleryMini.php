<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: ../../../Kazoku/login.php');
}
// INIT
$dir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR;
$tdir = __DIR__ . DIRECTORY_SEPARATOR . "thumbnail" . DIRECTORY_SEPARATOR;
$maxLong = 600; // maximum width or height, whichever is longer
$quality = 40;
$images = [];

// READ FILES FROM GALLERY FOLDER
$files = glob($dir . "*.{jpg,jpeg,gif,png}", GLOB_BRACE);

// CHECK AND GENERATE THUMBNAILS
foreach ($files as $f) {
    $img = basename($f);
    $images[] = $img;
    if (!file_exists($tdir . $img)) {
        list ($width, $height) = getimagesize($dir . $img);
        $ratio = $width > $height ? $maxLong / $width : $maxLong / $height ;
        $newWidth = ceil($width * $ratio);
        $newHeight = ceil($height * $ratio);
        $source = imagecreatefromjpeg($dir . $img);
        $destination = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($destination, $tdir . $img, $quality);
    }
}

// DRAW HTML ?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="es">
<head>
    <!-- Site Title-->
    <title>Galeria</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <script src="../assets/jquery-3.2.1.min.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600%7CRoboto:400,900">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../form/style.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>

    <link href="2-box.css" rel="stylesheet">
    <script src="3-thumbnail.js"></script>
</head>
<body style="background-color: #293541">

<!-- [LIGHTBOX] -->
<div id="lfront" class="w-100"></div>
<div id="lback" class="w-100"></div>

<!-- [THE GALLERY] -->
<div id="gallery" class="text-center align-content-center mx-4" >

    <?php
    foreach ($images as $i) {
        printf("<img src='thumbnail/%s' onclick='gallery.show(this)'/>", basename($i));
    }
    ?></div>


<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="../assets/js/core.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../form/scripts.js"></script>

</body>
</html>