<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>GENERIC - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>

            <div class="container-fluid">

                <!-- Start: Chart -->

                <!-- End: Chart -->
                <div class="row">
                    <div class="col-lg-6 mb-4">


                    </div>

                </div>
            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
</body>

</html>