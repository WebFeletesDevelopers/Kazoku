<div class="card-header py-3">
    <p class="text-primary m-0 font-weight-bold">Inserta tus datos</p>
</div>
<div class="card-body">
    <div>
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
                <div class="form-group"><label for="first_name"><strong>Tu nombre</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Nombre']?>" name="first_name"></div>
            </div>
            <div class="col">
                <div class="form-group"><label for="last_name"><strong>Primer Apellido</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Apellido1']?>" name="last_name"></div>
            </div>
            <div class="col">
                <div class="form-group"><label for="last_name"><strong>Segundo Apellido</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Apellido2']?>" name="last_name"></div>
            </div>
        </div>
    </div>
</div>