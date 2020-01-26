<div class="aside-component">
                  <!-- Heading Component-->
                  <article class="heading-component">
                    <div class="heading-component-inner">
                      <h5 class="heading-component-title"><?=$Mensajes->ProximosCampeonatos?>
                      </h5>
                    </div>
                  </article>

                  <!-- List Post Modern-->
                  <div class="list-post-modern">
                    <!-- Post Modern-->
                      <?php foreach (json_decode($ArrayCampeonatos) as $Campeonato) { ?>
                      <article class="post-modern">
                      <div class="post-modern-aside">
                        <p class="post-modern-date"><?=$Campeonato->Dia?></p>
                        <p class="post-modern-month"><?=$Campeonato->Mes?></p>
                      </div>
                      <div class="post-modern-main">
                        <!-- Badge-->
                        <div class="badge badge-primary"><?=$Campeonato->Nivel?>
                        </div>
                        <p class="post-classic-title"><a href="blog-post.html"><?=$Campeonato->Lugar?></a></p>
                      </div>
                    </article>
                      <?php } ?>
                  </div>
                </div>