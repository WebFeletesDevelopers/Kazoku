<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/stop.png&quot;);"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">MATTE!</h4>
                                </div>
                                <div class="user">
                                    <?php
                                    if($_SESSION['Rango']==3){
                                        echo '<div id="message" class="text-center alert alert-danger">No hemos encontrado un perfil de alumno enlazado a tu cuenta</div>';
                                    }
                                    elseif ($_SESSION['Rango']==2){
                                        echo '<div id="message" class="text-center alert alert-danger">No hemos encontrado ningún hijo enlazado a tu cuenta</div>';
                                    }
                                    ?>
                                    <div class="form-group"><a href="../../alta.php"> <button  class="btn btn-primary btn-block text-white btn-user" type="submit" id="but_submit">Crear perfil</button> </a></div>
                                    <div class="form-group"><a href="../../enlazar.php"> <button  class="btn btn-primary btn-block text-white btn-user" type="submit" id="but_submit">Enlazar perfil existente</button> </a></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>