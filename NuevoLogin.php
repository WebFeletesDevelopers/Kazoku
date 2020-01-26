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
        <section class="section parallax-container breadcrumbs-wrap" data-parallax-img="images/bg-breadcrumbs-1-1920x726.jpg">
            <div class="parallax-content breadcrumbs-custom context-dark">
                <div class="container">
                    <h3 class="breadcrumbs-custom-title"><?=$Navegacion->LoginRegistro?></h3>
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="<?=$Rutas->Index?>"><?=$Navegacion->Inicio?></a></li>
                        <li class="active"><?=$Navegacion->LoginRegistro?></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Section Login/register-->
        <section class="section section-variant-1 bg-gray-100">
            <div class="container">
                <div class="row row-50 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="card-login-register" id="card-l-r">
                            <div class="card-top-panel">
                                <div class="card-top-panel-left">
                                    <h5 class="card-title card-title-login"><?=$Navegacion->Login?></h5>
                                    <h5 class="card-title card-title-register"><?=$Navegacion->Registro?></h5>
                                </div>
                                <div class="card-top-panel-right"><span class="card-subtitle"><span class="card-subtitle-login"><?=$Navegacion->Registrate?></span><span class="card-subtitle-register"><?=$Navegacion->Login?></span></span>
                                    <button class="card-toggle" data-custom-toggle="#card-l-r"><span class="card-toggle-circle"></span></button>
                                </div>
                            </div>
                            <div class="card-form card-form-login">
                                <form class="rd-form rd-mailform">
                                    <div class="form-wrap">
                                        <label class="form-label" for="form-login-name-1"><?=$Navegacion->Login?></label>
                                        <input class="form-input" id="form-login-name-1" type="text" name="txt_uname1" data-constraints="@Required">
                                    </div>
                                    <div class="form-wrap">
                                        <label class="form-label" for="form-login-password-1"><?=$Navegacion->Contra?></label>
                                        <input class="form-input" id="form-login-password-1" type="password" name="txt_pwd1" data-constraints="@Required">
                                    </div>
                                    <label class="checkbox-inline checkbox-inline-lg checkbox-light">
                                        <input name="input-checkbox-1" value="checkbox-1" type="checkbox"><?=$Navegacion->Recuerdame?>
                                    </label>
                                    <button class="button button-lg button-primary button-block" type="submit" id="but_submit"><?=$Navegacion->Login?></button>
                                </form>
                                <div class="group-sm group-sm-justify group-middle"><a class="button button-google button-icon button-icon-left button-round" href="#"><span class="icon fa fa-google-plus"></span><span>Google+</span></a><a class="button button-twitter button-icon button-icon-left button-round" href="#"><span class="icon fa fa-twitter"></span><span>Twitter</span></a><a class="button button-facebook button-icon button-icon-left button-round" href="#"><span class="icon fa fa-facebook"></span><span>Facebook</span></a></div>
                            </div>
                            <div class="card-form card-form-register">
                                <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                                    <div class="form-wrap">
                                        <label class="form-label" for="form-register-email"><?=$Mensajes->TuCorreo?></label>
                                        <input class="form-input" id="form-register-email" type="email" name="email" data-constraints="@Email @Required">
                                    </div>
                                    <div class="form-wrap">
                                        <label class="form-label" for="form-login-name-2"><?=$Navegacion->Login?></label>
                                        <input class="form-input" id="form-login-name-2" type="text" name="form-input" data-constraints="@Required">
                                    </div>
                                    <div class="form-wrap">
                                        <label class="form-label" for="form-login-password-2"><?=$Mensajes->Contra?></label>
                                        <input class="form-input" id="form-login-password-2" type="password" name="password" data-constraints="@Required">
                                    </div>
                                    <div class="form-wrap">
                                        <label class="form-label" for="form-login-password-3"><?=$Mensajes->RepContra?></label>
                                        <input class="form-input" id="form-login-password-3" type="password" name="password" data-constraints="@Required">
                                    </div>
                                    <button class="button button-lg button-primary button-block" type="submit"><?=$Mensajes->CrearCuenta?></button>
                                </form>
                                <div class="group-sm group-sm-justify group-middle"><a class="button button-google button-icon button-icon-left button-round" href="#"><span class="icon fa fa-google-plus"></span><span>Google+</span></a><a class="button button-twitter button-icon button-icon-left button-round" href="#"><span class="icon fa fa-twitter"></span><span>Twitter</span></a><a class="button button-facebook button-icon button-icon-left button-round" href="#"><span class="icon fa fa-facebook"></span><span>Facebook</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Page Footer-->
      <?php 
        include 'site/template/footer.php'; 
        include 'site/template/videomodal.php';
        include 'site/template/scripts.php';
        include 'site/js/ScriptLogin.php';
        include 'site/js/ScriptRegistro.php';
     ?>
  </body>
</html>