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
$sql2= "select * from direccion where CodDireccion = $alumno->CodDireccion";
$query = $con->query($sql2);
$direccion = null;
if(isset($query->num_rows)){
    if($query->num_rows>0){
        while ($r=$query->fetch_object()){
            $direccion=$r;
            break;
        }
    }
}
switch ($alumno->CodCinturon){
    case 1:
        $cinturon = 'Blanco';
        break;
    case 2:
        $cinturon = 'Blanco-Amarillo';
        break;
    case 3:
        $cinturon = 'Amarillo-Naranja';
        break;
    case 4:
        $cinturon = 'Naranja-verde';
        break;
    case 5:
        $cinturon = 'Verde';
        break;
    case 6:
        $cinturon = 'Verde-Azul';
        break;
    case 7:
        $cinturon = 'Azul';
        break;
    case 8:
        $cinturon = 'Azul-Marrón';
        break;
    case 9:
        $cinturon = 'Marrón';
        break;
    case 10:
        $cinturon = 'Negro';
        break;
    default:
        $cinturon = 'Blanco';

}
$date = DateTime::createFromFormat('Y-m-d', $alumno->FechaNacimiento)->getTimestamp();
$newDate = date("d/m/Y", $date);
$yearN = date("Y",$date);
$edad = date("Y") - $yearN;
?>

<?php if($alumno!=null):?>
    <form role="form" method="post" action="php/actualizar.php" class=" text-center mx-auto" style="color: white">
        <div class=" row text-center" tyle="color: white">
            <div class=" col-md-12 text-center">
                <img class=" img-thumbnail img-circle img-fluid" src='../assets/img/profile/<?= $alumno->DNI; ?>.png '  onerror="this.src='../assets/img/profile/generic.png';" width="200" height="200">

            </div>
            <div class=" col-md-12 " tyle="color: white">
                <h3 class=" mb-0">Datos de <?= $alumno->Nombre; ?></h3>
                <h4 class=" mt-0"><?= $alumno->Apellido1; ?> <?= $alumno->Apellido2; ?></h4>
            </div>
            <div class=" col-md-12">
                <h5 class=" mb-0">DNI/NIE/PAS <?php if(isset($alumno->DNI)){ echo $alumno->DNI;}else{echo "N/A";} ?></h5>
                <h4 class=" mt-4 mb-0"> <?= $newDate; ?> </h4>
                <h4 class=" mt-0 mb-5">Edad <?= $edad; ?> años</h4>
                <img src="../assets/img/cintos/<?= $cinturon; ?>.png" class=" mt-0 mb-5">
            </div>
        </div>
        <hr class=" my-5">
        <div class=" mb-3 text-center ">
            <label for="IdFanjyda">ID FANJYDA <span class=" text-muted"></span></label>
            <input type="text" class=" form-control text-center " id="IdFanjyda" placeholder="<?= $alumno->IdFanjyda; ?>">
        </div>

        <div class=" mb-3 text-center ">
            <label for="username">Nombre de Usuario</label>
            <div class=" input-group">
                <input type="text" class=" form-control text-center container" id="username" value="<?= $alumno->Nombre; ?><?= $alumno->Apellido1; ?>" required>
            </div>
        </div>

        <div class=" mb-3 text-center ">
            <label for="email">Email <span class=" text-muted"></span></label>
            <input type="email" class=" form-control text-center " id="email" value="<?php if($alumno->Email!=null){echo $alumno->Email;}else{"No Existe";}; ?>">
        </div>

        <div class=" col-md-6 mb-3 text-center ">
            <label for="address">Direccion</label>
            <input type="text" class=" form-control text-center " id="Direccion" value="<?php if(isset($direccion->Direccion)){echo $direccion->Direccion;}else{echo "N/A";}; ?>" required>
        </div>
            <div class=" col-md-3 mb-3 text-center ">
                <label for="zip">Código Postal</label>
                <input type="text" class=" form-control text-center " id="CodPostal" value="<?php if(isset($direccion->CodPostal)){echo $direccion->CodPostal;}else{echo "N/A";}; ?>" required>
            </div>
            <div class=" col-md-3 mb- text-center ">
                <label for="zip">Localidad</label>
                <input type="text" class=" form-control text-center " id="Localidad" value="<?php if(isset($direccion->Localidad)){echo $direccion->Localidad;}else{echo "N/A";}; ?>" required>
            </div>
        </div>
        <div class=" row text-center">
            <div class=" form-group mb-3 text-center datosAl container-fluid">
                <label for="Nombre">Nombre</label>
                <input type="text" class=" form-control text-center" value="<?= $alumno->Nombre; ?>" name="Nombre" required>
            </div>
            <div class=" form-group mb-3 text-center datosAl container-fluid">
                <label for="Apellido1">Apellido 1</label>
                <input type="text" class=" form-control text-center" value="<?= $alumno->Apellido1; ?>" name="Apellido1" required>
            </div>
            <div class=" form-group mb-3 text-center datosAlp container-fluid">
                <label for="Apellido2">Apellido 2</label>
                <input type="text" class=" form-control text-center container-fluid" value="<?= $alumno->Apellido2; ?>" name="Apellido2">
            </div>
            <div class=" form-group mb-3 text-center datosAl container-fluid">
                <label for="Sexo">Sexo</label>
                <input type="text" class=" form-control text-center container-fluid" value="<?php switch($alumno->Sexo){case 1: echo "Masculino"; break; case 2: echo "Femenino"; break;}; ?>" name="Sexo" required>
            </div>
            <div class=" form-group mb-3 text-center datosAl container-fluid">
                <label for="DNI">DNI</label>
                <input type="text" class=" form-control text-center container-fluid " value="<?= $alumno->DNI; ?>" name="DNI" >
            </div>
            <div class=" form-group mb-3 text-center datosAl container-fluid ">
                <label for="FechaNacimiento">Fecha Nacimiento</label>
                <input type="text" class=" form-control text-center container-fluid" value="<?php if(isset($alumno->FechaNacimiento)){echo $newDate;}else{echo "N/A";}; ?>" name="FechaNacimiento" >
            </div>
            <input type="hidden" name="CodAlumno" value="<?= $alumno->CodAlumno; ?>"><br>
        </div>
        <div></div>
        <button type="submit" class=" container-fluid btn btn-primary sticky-bottom">Actualizar</button>

    </form>
<?php else:?>
    <p class=" alert alert-danger">404 No se encuentra</p>
<?php endif;?>