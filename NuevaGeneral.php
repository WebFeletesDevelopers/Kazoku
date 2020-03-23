<!DOCTYPE html>
<html class="wide wow-animation" lang="es">
<?php include 'site/testing.php' ?>
<?php include 'site/template/head.php' ?>
  <body>
    <!-- Preloader -->
    <?php include 'site/template/preloader.php' ?>
    <!-- pagina-->
    <div class="page">
      <!-- Encabezado-->
    <?php include 'site/template/header.php' ?>
      <!-- Swiper-->
      <?php include 'site/template/swiper.php' ?>
      <!-- Carrusel de noticias-->
      <?php include 'site/template/news.php' ?>

      <!-- Latest News-->
      <section class="section section-md bg-white">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-8">
                     <div class="main-component">
                    </div>
                    <div class="main-component">
                        <!-- Heading Component-->
                         <?php include 'site/template/tituloComponente.php' ?>
                         <?php include 'site/template/pagination.php' ?>
                     </div>
             </div>
             <div class="col-lg-4">
             <?php include 'site/template/proximamente.php' ?>
            </div>
      </section>

      <!-- Page Footer-->
      <?php 
        include 'site/template/footer.php'; 
        include 'site/template/videomodal.php';
        include 'site/template/scripts.php'
     ?>
     </div>
  </body>
</html>