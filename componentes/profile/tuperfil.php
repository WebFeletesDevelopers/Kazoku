<h3 class="text-dark mb-4">Tu perfil</h3>
<div class="row mb-3">
    <div class="col-lg-4">
        <div class="card mb-3">

            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="/assets/img/profile/<?php if(file_exists("assets/img/profile/".$alumno->DNI.'.png')){echo $alumno->DNI;}else{echo "generic";}  ?>.png"   width="160" height="160">
                <div class="mb-3 h-auto"><img src="/assets/img/cintos/Negro.png" class="img-fluid"  alt="..."></div>
            </div>
        </div>
        <?php include 'clase.php'; ?>

    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Tus datos</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="username"><strong>Nombre de Usuario</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['name']?>" name="username"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="email"><strong>Tu correo</strong></label><input class="form-control" type="email" placeholder="<?= $_SESSION['Email']?>" name="email"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="first_name"><strong>Tu nombre</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Nombre'] ?>" name="first_name"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="last_name"><strong>Apellido(s)</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Apellido1'].' '.$_SESSION['Apellido2'] ?> " name="last_name"></div>
                                </div>
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Actualizar datos</button> <small>tendrás que volver a iniciar sesión si los cambias...</small></div>
                        </form>
                    </div>
                </div>
                <?php include 'otros.php'; ?>
            </div>
        </div>
    </div>
</div>