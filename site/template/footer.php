<footer class="section footer-modern footer-modern-dark context-dark">
    <div class="footer-modern-aside text-center text-sm-left">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-start no-gutters">
                <div class="col-md-11 col-lg-7">
                    <div class="footer-modern-left">
                        <div class="unit flex-column flex-sm-row align-items-center unit-bordered">
                            <div class="unit-left"><a class="brand brand-md" href="<?= $Rutas->Index ?>"><img
                                            class="brand-logo "
                                            src="<?= $Rutas->LogoXS ?>"
                                            alt="" width="81"
                                            height="81"/></a>
                                <div class="group-item">
                                    <h4 class="letter-spacing-01"><?= $Club->NombreCorto ?></h4>
                                    <p class="text-style-4"><?= $Club->SitioPrincipal ?></p>
                                </div>
                            </div>
                            <div class="unit-body">
                                <p><?= $Club->Lema ?> <br class="d-none d-xxl-block">Somos de Málaga y Fuengirola.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-11 col-lg-5">
                    <div class="footer-modern-right">
                        <ul class="list-inline list-inline-bordered list-inline-bordered-lg">
                            <li>
                                <div class="unit unit-horizontal align-items-center">
                                    <div class="unit-left"><img class="icon-image"
                                                                src="<?= $Rutas->LogoXS ?>" alt=""
                                                                width="38" height="35"/>
                                    </div>
                                    <div class="unit-body">
                                        <h6><?= $Mensajes->RRSS ?></h6>
                                        <ul class="list-inline list-inline-xs">
                                            <li><a class="icon icon-default fa fa-facebook" href="#"></a></li>
                                            <li><a class="icon icon-default fa fa-twitter" href="#"></a></li>
                                            <li><a class="icon icon-default fa fa-google-plus" href="#"></a></li>
                                            <li><a class="icon icon-default fa fa-instagram" href="#"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="unit unit-horizontal align-items-center">
                                    <div class="unit-left"><img class="icon-image"
                                                                src="<?= $Rutas->LogoXS ?>" alt=""
                                                                width="34" height="34"/>
                                    </div>
                                    <div class="unit-body">
                                        <h6><?= $Mensajes->Contacto ?></h6><a class="link"
                                                                              href=<?= '"mailto:' . $Club->CorreoAdministracion . '"' ?>><?= $Club->CorreoAdministracion ?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-modern-main">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-4">
                    <h5><?= $Mensajes->Galeria ?></h5>
                    <article class="gallery" data-lightgallery="group">
                        <div class="row row-10 row-narrow">
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '
                            <div class="col-4 col-sm-2 col-lg-4"><a class="thumbnail-creative" data-lightgallery="item" href="site/images/baseball/gallery-baseball-1-original.jpg"><img src="images/baseball/gallery-baseball-1-105x105.jpg" alt="">
                              <div class="thumbnail-creative-overlay"></div></a>
                            </div>';
                            }
                            ?>
                        </div>
                    </article>
                </div>
                <div class="col-md-7 col-lg-5">
                    <h5><?= $Mensajes->Noticias ?></h5>
                    <div class="row row-20">

                        <?php
                        include_once 'site/controller/NoticiasController.php';
                        $i = 0;
                        foreach ($noticias as $NoticiaFooter) {
                            if (++$i === 5) break;
                            ?>
                            <div class="col-sm-6">
                                <!-- Post Classic-->
                                <article class="post-classic">
                                    <div class="post-classic-main">
                                        <!-- Badge-->

                                        <div class="badge badge-primary"><?= $NoticiaFooter->Titulo ?>
                                        </div>
                                        <p class="post-classic-title"><a
                                                    href="site/blog-post.html"><?= $NoticiaFooter->Cuerpo ?></a></p>
                                        <div class="post-classic-time"><span class="icon mdi mdi-clock"></span>
                                            <time datetime="2018"><?= $NoticiaFooter->Fecha ?></time>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-5 col-lg-3">
                    <h5><?= $Mensajes->Contacto ?></h5>
                    <form class="rd-form form-sm rd-mailform" data-form-output="form-output-global"
                          data-form-type="contact" method="post" action="site/bat/rd-mailform.php">
                        <div class="form-wrap">
                            <label class="form-label" for="footer-form-email"><?= $Mensajes->TuCorreo ?></label>
                            <input class="form-input" id="footer-form-email" type="email" name="email"
                                   data-constraints="@Email @Required">
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="footer-form-message"><?= $Mensajes->TuMensaje ?></label>
                            <textarea class="form-input" id="footer-form-message" name="message"
                                      data-constraints="@Required"></textarea>
                        </div>
                        <div class="form-wrap">
                            <button class="button button-lg button-primary button-block"
                                    type="submit"><?= $Mensajes->Enviar ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="layout-justify">
                <p class="rights"><span><?= $Club->Nombre ?></span><span>&nbsp;&copy;&nbsp;</span><span
                            class="copyright-year"></span><span>.&nbsp;</span><a
                            class="link-underline" href="site/privacy-policy.html"><?= $Mensajes->privacidad ?></a></p>
                <nav class="nav-minimal">
                    <ul class="nav-minimal-list">
                        <li class="active"><a href="<?= $Rutas->Index ?>"><?= $Navegacion->Inicio ?></a></li>
                        <li><a href="site/#"><?= $Navegacion->Calendario ?></a></li>
                        <li><a href="site/#"><?= $Navegacion->Federacion ?></a></li>
                        <li><a href="site/team.html"><?= $Navegacion->Club ?></a></li>
                        <li><a href="site/news.html"><?= $Navegacion->Noticias ?></a></li>
                        <li><a href="site/grid-shop.html"><?= $Mensajes->Tienda ?></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>