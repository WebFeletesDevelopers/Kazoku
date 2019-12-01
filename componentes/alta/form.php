<?php
    switch($_SESSION['Rango']){
        case 0:
            $msg = "ATENCIÓN: Sus datos no se guardarán relacionados con el alumno/a";
            break;
        case 1:
            $msg = "ATENCIÓN: Sus datos no se guardarán relacionados con el alumno/a";
            break;
        case 2:
            $msg = "ATENCIÓN: Sus datos  se guardarán relacionados con el alumno/a, siendo user su tutor/a";
            break;
        case 3:
            $msg = "ATENCIÓN: Sus datos serán guardados como alumno/a";
            break;
        default:
            $msg = "ATENCIÓN: Sus datos no se guardarán, contacte con el administrador del sistema";
    }

?>


<div class="m-1">
    <div class="row mb-3">

        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Insertar datos</p>
                            <div>
                                <div class="alert alert-danger"><?= $msg ?></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="form-row">
                                    <div class="col">

                                        <div class="form-group"><label for="username"><strong>Nombre de Usuario</strong></label><input class="form-control" type="text" placeholder="<?php if($_SESSION['Rango']==3){echo $_SESSION['name'];}?>" name="uname" id="Uname" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="username"><strong>Contraseña</strong></label><input class="form-control" type="text" placeholder="" name="password" id="Password" required></div>
                                        <div class="form-group"><label for="username"><strong>Repetir Contraseña</strong></label><input class="form-control" type="text" placeholder="" name="password" id="Password2" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="email"><strong>Correo</strong></label><input class="form-control" type="email" placeholder="<?php if($_SESSION['Rango']==3){echo $_SESSION['Email'];}?>" name="email" id="Email"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>Nombre</strong></label><input class="form-control" type="text" placeholder="<?php if($_SESSION['Rango']==3){echo $_SESSION['Nombre'];}?>" name="Nombre" id="Nombre" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_name"><strong>Primer Apellido</strong></label><input class="form-control" type="text" placeholder="<?php if($_SESSION['Rango']==3){echo $_SESSION['Apellido1'];}?>" name="Apellido1" id="Apellido1" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_name"><strong>Segundo Apellido</strong></label><input class="form-control" type="text" placeholder="<?php if($_SESSION['Rango']==3){echo $_SESSION['Apellido2'];}?>" id="Apellido2" name="Apellido2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Datos de dirección</p>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="form-group"><label for="address"><strong>Dirección</strong></label><input class="form-control" type="text" placeholder="Calle" name="Direccion" id="Direccion"></div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="city"><strong>Localidad</strong></label><input class="form-control" type="text" placeholder="Localidad" name="Localidad" id="Localidad"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="country"><strong>Provincia</strong></label><input class="form-control" type="text" placeholder="Provincia" name="Provincia" id="Provincia"></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-sm">Insertar datos</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>