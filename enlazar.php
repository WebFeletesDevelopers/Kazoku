<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../../login.php');
}

//include "php/conexion.php";
$nombre = $_SESSION['Nombre'];
$ape1 = $_SESSION['Apellido1'];
$user_id=null;
//$sql1= "select * from `alumno` where `Nombre` like('$nombre') and `Apellido1` like('$ape1'); "; */

include_once 'PDO/database.php';
$sentencia = $bd->query("SELECT * FROM alumno where `Nombre` like('$nombre') and `Apellido1` like('$ape1');");
$alumno = $sentencia->fetchAll(PDO::FETCH_OBJ);
//$query = $con->query($sql1);
function asignarCinturon($CodCinturon){
    switch ($CodCinturon) {
        case 1:
            $response = 'Blanco';
            break;
        case 2:
            $response = 'Blanco-Amarillo';
            break;
        case 3:
            $response = 'Amarillo-Naranja';
            break;
        case 4:
            $response = 'Naranja-verde';
            break;
        case 5:
            $response = 'Verde';
            break;
        case 6:
            $response = 'Verde-Azul';
            break;
        case 7:
            $response = 'Azul';
            break;
        case 8:
            $response = 'Azul-Marrón';
            break;
        case 9:
            $response = 'Marrón';
            break;
        case 10:
            $response = 'Negro';
            break;
        default:
            $response = 'Blanco';

    }
    return $response;
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Enlazar - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>
<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <div class="container text-center">
                <h3 class="text-dark mb-4">Alumnado</h3>
                <div class="card shadow text-center ">
                    <div class="card-header py-3 text-center">
                        <p class="text-primary m-0 font-weight-bold">Enlazar cuentas</p>
                    </div>
                    <?php if(1==1):?>
                    <?php foreach($alumno as $alu){

                        $originalDate = $alu->FechaNacimiento;
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        ?>
                        <div class="row my-0">
                            <div class="col-md-4">
                                <img class="card-img-top text-center img-fluid" src="/site/images/profile/<?php if(file_exists("site/images/profile/".$alu->DNI.'.png')){echo "$alu->DNI";}else{echo "generic";}  ?>.png">
                            </div>
                            <div class="col-md-8" style="width: 18rem;">
                                <div class="card-body text-left">
                                    <h5 class="card-title"><?= $alu->Nombre; ?></h5>
                                    <h5><?= $alu->Apellido1.' '.$alu->Apellido2; ?></h5>
                                    <p class="card-text">Sexo: <?php if($alu->Sexo==1){echo "Masculino";}else{echo "Femenino";}?></p>
                                    <p class="card-text">Cinturón: <?php  if(isset($alu->CodCinturon)){ echo asignarCinturon($alu->CodCinturon);} else{ echo "Blanco";}?></p>
                                    <p class="card-text">ID FANJYDA: <?= $alu->IdFanjyda; ?></p>
                                    <p class="card-text">DNI: <?= $alu->DNI; ?></p>
                                    <?php

                                    ?>
                                    <div class="text-left col-md-4">
                                        <a href="" class="btn btn-primary my-2  container-fluid">Soy yo</a>
                                        <form method="post" action="PDO/delete.php">
                                            <button class="btn btn-danger my-2 container fluid">No soy yo</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php };?>
                    <?php else:?>
                     <p class="alert alert-warning">No hay resultados</p>

                    <button class="btn btn-primary" href="enlazar.php">Crear perfil</button>
                   <?php endif;?>
                </div>
            </div>
        </div>

        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
</body>

</html>