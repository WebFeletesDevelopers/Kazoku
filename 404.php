<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ERROR - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="text-center mt-5">
                        <div class="error mx-auto" data-text="404">
                            <p class="m-0">404</p>
                        </div>
                        <p class="text-dark mb-5 lead">Página no encontrada</p>
                        <p class="text-black-50 mb-0">Has encontrado un fallo en la matriz</p>
                        <a href="/">Volver al inicio</a></div>
                </div>
            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
</body>

</html>