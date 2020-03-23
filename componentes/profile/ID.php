<h3 class="text-dark mb-4">Perfil de <?=$alumno->Nombre ?> </h3>
<div class="row mb-3">
    <div class="col-lg-4">
        <div class="card mb-3">

            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="/assets/img/profile/<?php if(file_exists("assets/img/profile/".$alumno->DNI.'.png')){echo $alumno->DNI;}else{echo "generic";}  ?>.png"   width="160" height="160">
                <div class="mb-3 h-auto"><img src="/assets/img/cintos/Negro.png" class="img-fluid"  alt="..."></div>
            </div>
        </div>
        <?php if($alumno->CodClase !=null){ include 'clase.php'; } else{ echo '<div class="alert alert-danger">No hay datos de clase</div>';} ?>

    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Datos</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="username"><strong>Nombre de Usuario</strong></label><input class="form-control" type="text" placeholder="<?= $alumno->Nombre?>" name="username"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="email"><strong>Correo</strong></label><input class="form-control" type="email" placeholder="<?= $alumno->Email ?>" name="email"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="first_name"><strong>Nombre</strong></label><input class="form-control" type="text" placeholder="<?= $alumno->Nombre?>" name="first_name"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="last_name"><strong>Apellido(s)</strong></label><input class="form-control" type="text" placeholder="<?= $alumno->Apellido1.' '.$alumno->Apellido2 ?> " name="last_name"></div>
                                </div>
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Actualizar datos</button></div>
                        </form>
                    </div>
                </div>
                <?php if($alumno->CodDireccion !=null){ include 'otros.php'; } else{ echo '<div class="alert alert-danger">No hay datos de dirección</div>';} ?>
            </div>
        </div>
    </div>
</div>