<!DOCTYPE html>
<html class="wide wow-animation" lang="es">
<?php include 'site/template/head.php' ?>
<body>
<!-- Preloader -->
<?php include 'site/template/preloader.php' ?>
<!-- pagina-->
<div class="page">
    <!-- Encabezado-->
    <?php include 'site/template/header.php' ?>

    <section class="section section-variant-1 bg-gray-100 text-center">
        <div class="container">
            <div class="row row-30 justify-content-center">
                <div class="col-xl-6"><img src="<?=$Rutas->Stop?>" height="100px">
                    <h2><span class="text-red">Matte!</span> Página no encontrada</h2>
                    <p class="big text-gray-800"></p><a class="button button-lg button-primary" href="<?=$Rutas->Index ?>">Volver al inicio</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Footer-->
    <?php
    include 'site/template/footer.php';
    include 'site/template/videomodal.php';
    include 'site/template/scripts.php'
    ?>
</body>
</html>