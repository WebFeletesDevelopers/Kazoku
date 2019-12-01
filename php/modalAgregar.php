<!--<div class="text-center modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="text-center modal-dialog">
        <div class="text-center modal-content p-2 ">
            <div class="text-center ">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <h4 class="text-center modal-title m-3">Alta de alumno/a</h4><br>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="text-center close m-3" style="font-size: 2vw" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>

            </div>
            <div class="text-center modal-body">
                <form id="form1" name="form1" method="post" action="php/agregar.php" role="form" class="container-fluid text-center">
                    <label for="Nombre">Nombre</label><br><input class="text-center" type="text" name="Nombre" id="Nombre" required />
                    <br class="clear" />
                    <label for="Apellido1">Primer Apellido</label><br><input class="text-center" type="text" name="Apellido1" id="Apellido1" required />
                    <br class="clear" />
                    <label for="Apellido2">Segundo Apellido</label><br><input class="text-center" type="text" name="Apellido2" id="Apellido2" placeholder="Opcional" />
                    <br class="clear" />
                    <label for="Sexo">Sexo</label>
                    <select name="transporte" class="container-fluid text-center">
                        <option class="container-fluid">Masculino</option>
                        <option class="container-fluid">Femenino</option>
                    </select>
                    <br class="clear" />
                    <label for="IdFanjyda">Id fanjyda</label><br><input class="text-center" type="text" name="IdFanjyda" id="IdFanjyda" />
                    <br class="clear" />
                    <label for="DNI">DNI</label><br><input class="text-center" type="text" name="DNI" id="DNI" />
                    <br class="clear" />
                    <label for="FechaNacimiento">Fecha de nacimiento</label><br><input class="text-center" type="text" name="FechaNacimiento" id="FechaNacimiento" required />
                    <br class="clear" />
                    <label for="Telefono">Telefono del alumno (si tiene)</label><br><input class="text-center" type="text" name="Telefono" id="Telefono" />
                    <br class="clear" />
                    <label for="Enfermedad">�Alguna enfermedad?</label><textarea name="Enfermedad" id="Enfermedad" cols="45" rows="5"></textarea>
                    <br class="clear" /><br>
                    <input type="submit"  value="Enviar" class="btn btn-primary" />
                </form>
            </div>

        </div>
    </div>
</div>

-->


<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document" style="margin-left: -50%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulario de Alta <?= $_SESSION['CodUsu']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" name="form1" method="post" action="/kazoku/php/agregar.php" role="form" class="container-fluid text-center">
                    <label for="Nombre">Nombre</label><br><input class="text-center" type="text" name="Nombre" id="Nombre" required />
                    <br class="clear" />
                    <label for="Apellido1">Primer Apellido</label><br><input class="text-center" type="text" name="Apellido1" id="Apellido1" required />
                    <br class="clear" />
                    <label for="Apellido2">Segundo Apellido</label><br><input class="text-center" type="text" name="Apellido2" id="Apellido2" placeholder="Opcional" />
                    <br class="clear" />
                    <label for="Sexo">Sexo</label>
                    <select name="Sexo" class="container-fluid text-center">
                        <option class="container-fluid" name="Sexo" value="Masculino" selected>Masculino</option>
                        <option class="container-fluid" name="Sexo" value="Femenino">Femenino</option>
                    </select>
                    <br class="clear" />
                    <label for="IdFanjyda">Id fanjyda</label><br><input class="text-center" type="text" name="IdFanjyda" id="IdFanjyda" />
                    <br class="clear" />
                    <label for="DNI">DNI</label><br><input class="text-center" type="text" name="DNI" id="DNI" />
                    <br class="clear" />
                    <label for="FechaNacimiento">Fecha de nacimiento</label><br><input class="text-center" type="text" name="FechaNacimiento" id="FechaNacimiento" required />
                    <br class="clear" />
                    <label for="Telefono">Telefono del alumno (si tiene)</label><br><input class="text-center" type="text" name="Telefono" id="Telefono" />
                    <br class="clear" />
                    <label for="Enfermedad">¿Alguna enfermedad?</label><textarea name="Enfermedad" id="Enfermedad" cols="45" rows="5"></textarea>
                    <br class="clear" /><br>
                    <input type="hidden" id="CodUsu" name="CodUsu" value="<?= $_SESSION['CodUsu']?>">
                    <input type="submit"  value="Enviar" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>