<section class="section swiper-container swiper-slider swiper-modern bg-gray-2" data-loop="true" data-autoplay="4000" data-simulate-touch="true" data-slide-effect="fade">
        <div class="swiper-wrapper">
          <div class="swiper-slide" data-slide-bg="images/baseball/slider-slide-1-1920x652.jpg">
            <div class="container">
              <div class="swiper-slide-caption">
                <h3 data-caption-animate="fadeInLeftSmall"><?=$Club->NombreCompleto?></h3>
                <h1 class="heading-decoration-1" data-caption-animate="fadeInLeftSmall" data-caption-delay="100"><?=$Mensajes->TodaInformacion?></h1>
                <h1 class="text-secondary" data-caption-animate="fadeInLeftSmall" data-caption-delay="200"><?=$Mensajes->SobreNosotros?></h1><a class="button button-gray-outline" data-caption-animate="fadeInLeftSmall" data-caption-delay="400" href="about-us.html"><?=$Navegacion->LeerMas?></a>
              </div>
            </div>
          </div>
          <div class="swiper-slide" data-slide-bg="images/baseball/slider-slide-2-1920x652.jpg">
            <div class="container">
              <div class="swiper-slide-caption">
                <h3 data-caption-animate="fadeInLeftSmall"><?=$Mensajes->InformateNovedades?></h3>
                <h1 class="heading-decoration-1" data-caption-animate="fadeInLeftSmall" data-caption-delay="100"><?=$Mensajes->Campeonatos?></h1>
                <h1 class="text-secondary" data-caption-animate="fadeInLeftSmall" data-caption-delay="200"><?=$Mensajes->NoticiasResultados?></h1><a class="button button-gray-outline" data-caption-animate="fadeInLeftSmall" data-caption-delay="300" href="news.html"><?=$Navegacion->LeerMas?></a>
              </div>
            </div>
          </div>
          <div class="swiper-slide" data-slide-bg="images/baseball/slider-slide-3-1920x652.jpg">
            <div class="container">
              <div class="swiper-slide-caption">
                <h3 data-caption-animate="fadeInLeftSmall"><?=$Mensajes->CompraEquipacion?></h3>
                <h1 class="heading-decoration-1" data-caption-animate="fadeInLeftSmall" data-caption-delay="100"><?=$Mensajes->VisitaNuestra?></h1>
                <h1 class="text-secondary" data-caption-animate="fadeInLeftSmall" data-caption-delay="200"><?=$Mensajes->TiendaDeportiva?></h1><a class="button button-gray-outline" data-caption-animate="fadeInLeftSmall" data-caption-delay="300" href="grid-shop.html"><?=$Navegacion->LeerMas?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination swiper-pagination-vertical" data-index-bullet="true"></div>
      </section>