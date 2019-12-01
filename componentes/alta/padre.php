<div class="card-header py-3">
    <p class="text-primary m-0 font-weight-bold">Inserta los datos de su hijo/a</p>
</div>
<div class="card-body">
    <div>
        <div class="form-row">
            <div class="col">
                <div class="form-group"><label for="username"><strong>Nombre de Usuario</strong></label><input class="form-control" type="text" placeholder="Su nombre de usuario" name="Uname"></div>
            </div>
            <div class="col">
                <div class="form-group"><label for="email"><strong>DNI / NIE / PASAPORTE</strong><small> déjelo en blanco si no tiene</small></label><input class="form-control" type="text" placeholder="00000000X" name="email"></div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group"><label for="first_name"><strong>Su nombre</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Nombre']?>" name="Nombre"></div>
            </div>
            <div class="col">
                <div class="form-group"><label for="last_name"><strong>Su Primer Apellido</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Apellido1']?>" name="Apellido1"></div>
            </div>
            <div class="col">
                <div class="form-group"><label for="last_name"><strong>Su Segundo Apellido</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Apellido2']?>" name="lApellido2"></div>
            </div>
        </div>
    </div>
</div>