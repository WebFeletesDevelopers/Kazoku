<?php
session_start();
if($_SESSION['Confirmado']!=1){
    header('Location: ../wait.php');
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
 ?>

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

    <link href="2-box.css" rel="stylesheet">
    <script src="3-thumbnail.js"></script>

</head>
<body style="background-color: #293541">
<header class="section page-header rd-navbar-dark m-auto text-center">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap text-center">
        <nav class="rd-navbar rd-navbar-corporate" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="166px" data-xl-stick-up-offset="166px" data-xxl-stick-up-offset="166px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-panel rd-navbar-darker text-center">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle text-center" data-rd-navbar-toggle=".rd-navbar-main"><span></span></button>
                <!-- RD Navbar Panel-->

            </div>
            <div class="rd-navbar-main text-center">
                <div class="rd-navbar-main-bottom text-center">
                    <div class="rd-navbar-main-container container text-center">
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav text-center d-inline-block">
                            <li class="rd-nav-item active text-center d-inline-block">
                                <a class="rd-nav-link" href="../index.php">Inicio</a>
                            </li>
                            <?php
                            if($_SESSION['Rango']<2){
                            echo '<li class="rd-nav-item  text-center d-inline-block text-dark container-wide">
                                    <a style="color: white; background:black" type="button" class="rd-nav-link " data-toggle="modal" data-target="#exampleModal">
                                    Subir foto
                                    </a>
                                </li>';
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>


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


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subir foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#" enctype="multipart/form-data">
                    <div class="card text-center" style="border: none">
                        <img class="img-fluid card-img-top " style="align-self: center"  width="200" height="200">
                        <div class="card-body">
                            <h5 class="card-title">Sube una foto</h5>
                            <p class="card-text">Sube una imagen...</p>
                            <div class="form-group">
                                <label for="image">Nueva imagen</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                            <?php
                            if($_SESSION['Rango']<2){
                            echo "<input type='button' id='send' class='btn btn-primary upload' value='Subir'>";
                            }
                            ?>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="../assets/js/core.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../form/scripts.js"></script>
<script>
    $(document).ready(function() {
        $('.upload').on('click', function() {
            var formData = new FormData();
            var files = $('#image')[0].files[0];
            formData.append('file',files);
            $.ajax({
                url: 'upload.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $('.card-img-top').attr('src', response);
                    } else {
                        alert('Formato de imagen incorrecto.');
                    }
                }
            });
            return false;
        });
    });
    $(document).ready(function(){
        $('#send').click(function(){
            $('#gallery').load("Gallery/gallery.php");
        });
    });
</script>
</body>
</html>