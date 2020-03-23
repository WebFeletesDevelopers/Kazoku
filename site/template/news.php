<section class="section section-minimal bg-white">
    <div class="container container-wide">
        <div class="owl-carousel owl-carousel-creative" data-items="1" data-md-items="2" data-lg-items="3"
             data-autoplay="true" data-autoplay-speed="6500" data-dots="false" data-nav="true" data-stage-padding="0"
             data-loop="true" data-margin="30" data-lg-margin="20" data-xl-margin="30" data-mouse-drag="false">
            <!-- Post Lily-->

            <?php
            include_once 'site/controller/NoticiasController.php';
            foreach ($noticias as $noticia) {
                ?>
                <article class="post-lily"><img src="<?=$Rutas->LogoM?>" alt="" width="570"
                                                height="352"/>
                    <div class="post-lily-main">
                        <!-- Badge-->
                        <div class="badge badge-primary"><?= $noticia->Titulo ?>
                        </div>
                        <h4 class="post-lily-title"><a href="blog-post.html"><?= $noticia->Cuerpo ?></a></h4>
                        <div class="post-lily-meta">
                            <div class="post-lily-time"><span class="icon mdi mdi-clock"></span>
                                <time datetime="2017"><?= $noticia->Fecha." - ".$noticia->Autor?></time>
                            </div>

                        </div>
                    </div>
                </article>
                <!-- Post Lily-->
            <?php } ?>
        </div>
    </div>
</section>