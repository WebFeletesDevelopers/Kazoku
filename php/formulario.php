<?php
include "conexion.php";

$user_id=null;
$sql1= "select * from alumno where CodAlumno = ".$_GET["CodAlumno"];
$query = $con->query($sql1);
$alumno = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $alumno=$r;
  break;
}

  }
?>

<?php if($alumno!=null):?>

<form role="form" method="post" action="php/actualizar.php">
  <div class="form-group">
    <label for="Nombre">Nombre</label>
    <input type="text" class="form-control" value="<?= $alumno->Nombre; ?>" name="Nombre" required>
  </div>
  <div class="form-group">
    <label for="Apellido1">Apellido 1</label>
    <input type="text" class="form-control" value="<?= $alumno->Apellido1; ?>" name="Apellido1" required>
  </div>
    <div class="form-group">
        <label for="Apellido2">Apellido 2</label>
        <input type="text" class="form-control" value="<?= $alumno->Apellido2; ?>" name="Apellido2" required>
    </div>
  <div class="form-group">
    <label for="Sexo">Sexo</label>
    <input type="text" class="form-control" value="<?= $alumno->Sexo; ?>" name="Sexo" required>
  </div>
  <div class="form-group">
    <label for="IdFanjyda">ID Fanjyda</label>
    <input type="text" class="form-control" value="<?= $alumno->IdFanjyda; ?>" name="IdFanjyda" >
  </div>
  <div class="form-group">
    <label for="DNI">DNI</label>
    <input type="text" class="form-control" value="<?= $alumno->DNI; ?>" name="DNI" >
  </div>
    <div class="form-group">
        <label for="FechaNacimiento">Fecha Nacimiento</label>
        <input type="text" class="form-control" value="<?= $alumno->FechaNacimiento; ?>" name="FechaNacimiento" >
    </div>
<input type="hidden" name="CodAlumno" value="<?= $alumno->CodAlumno; ?>">
  <button type="submit" class="btn btn-default">Actualizar</button>
</form>
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>