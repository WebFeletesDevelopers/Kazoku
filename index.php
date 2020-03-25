<?php
session_start();
include 'site/controller/SessionController.php'
?>
<!DOCTYPE html>
<html>

<head>
    <title>Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'componentes/nav.php'; ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <div class="container-fluid">
                <?php include 'componentes/index/carousel.php'; ?>
                <?php include 'componentes/index/noticias.php'; ?>
                <!-- Start: Chart -->

            <!-- End: Chart -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <?php // include 'componentes/index/porcentajes.php'; ?>

                </div>

            </div>
        </div>
    </div>
    <?php include 'componentes/footer.php'; ?>
    <?php include 'componentes/commonscripts.php'; ?>
    <?php
    if(isConfirmed()) {
        include 'template/chat.php';
    }
    ?>


</body>

</html>
