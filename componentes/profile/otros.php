<div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">Otros datos</p>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group"><label for="address"><strong>Dirección</strong></label><input class="form-control" type="text" placeholder="<?= $direccion->Direccion ?>" name="Direccion"></div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group"><label for="city"><strong>Localidad</strong></label><input class="form-control" type="text" placeholder="<?= $direccion->Localidad ?>" name="Localidad"></div>
                </div>
                <div class="col">
                    <div class="form-group"><label for="country"><strong>Provincia</strong></label><input class="form-control" type="text" placeholder="<?= $direccion->Provincia ?>" name="Provincia"></div>
                </div>
            </div>
            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Actualizar datos</button> <small>tendrás que volver a iniciar sesión si los cambias...</small></div>
        </form>
    </div>
</div>