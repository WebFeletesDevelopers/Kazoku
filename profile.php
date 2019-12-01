<?php
session_start();

if(!isset($_SESSION['Rango'])){
    header('Location: ./login.php');
}

include_once 'PDO/database.php';
$bd = crear();
if($_SESSION['Rango']<2 && isset($_GET['CodAlumno'])){
    if(isset($_GET['CodAlumno']) &&  $_SESSION['Rango']<2){
        $id =$_GET['CodAlumno'];
    }
    else{
        $id = $_SESSION['CodUsu'];
    }
    //require 'php/conexion.php';
    $sentencia = $bd->query("SELECT * FROM alumno WHERE CodAlumno =  $id;");
    $alumno = $sentencia->fetchObject();
    if($alumno->CodDireccion !== NULL){
        $codDir = $alumno->CodDireccion;
    }
    else{
        $codDir = 0;
    }
    $sentencia = $bd->query("SELECT * FROM direccion WHERE CodDireccion = ".$codDir);
    $direccion = $sentencia->fetchObject();

    /*
    $sql2 = "select * from direccion where CodDireccion = $alumno->CodDireccion";
    $query = $con->query($sql2);
    $direccion = null;
    if (isset($query->num_rows)) {
        if ($query->num_rows > 0) {
            while ($r = $query->fetch_object()) {
                $direccion = $r;
                break;
            }
        }
    } */
    if($alumno->CodClase !=null){
        $sentencia = $bd->query("SELECT * FROM clase WHERE CodClase = ".$alumno->CodClase);
        $clase = $sentencia->fetchObject();
        //$sql2 = "select * from clase where CodClase = $alumno->CodClase";
        //$query = $con->query($sql2);
        /*$clase = null;
        if (isset($query->num_rows)) {
            if ($query->num_rows > 0) {
                while ($r = $query->fetch_object()) {
                    $clase = $r;
                    break;
                }
            }
        } */
        $sentencia = $bd->query("SELECT * FROM centro WHERE CodCentro = ".$clase->CodCentro);
        $Centro = $sentencia->fetchObject();
        /*
        $sql3 = "select * from centro where CodCentro = $clase->CodCentro";
        $query = $con->query($sql3);
        $Centro = null;
        if (isset($query->num_rows)) {
            if ($query->num_rows > 0) {
                while ($r = $query->fetch_object()) {
                    $Centro = $r;
                    break;
                }
            }
        }
        */
    }
    switch ($alumno->CodCinturon) {
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
    $Range = $_SESSION['Rango'];
    switch ($Range) {
        case 0:
            $Range = 'Administrador';
            break;
        case 1:
            $Range = 'Profesor';
            break;
        case 2:
            $Range = 'Alumno';
            break;
        case 3:
            $Range = 'Tutor';
            break;
        default:
            $Range = "N/A";
    }


    $date = DateTime::createFromFormat('Y-m-d', $alumno->FechaNacimiento)->getTimestamp();
    $newDate = date("d/m/Y", $date);
    $yearN = date("Y", $date);
    $edad = date("Y") - $yearN;
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Perfil - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
    <div id="wrapper">
         <?php include 'componentes/nav.php'; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include 'componentes/navbar.php'; ?>

                <div class="container-fluid">
                    <?php
                    if($_SESSION['Rango']<2 && isset($_GET['CodAlumno'])){
                        include 'componentes/profile/ID.php';
                    }else{
                        if($_SESSION['Alta']==false) {
                            include 'componentes/profile/noperfil.php';
                        }
                        else{
                            include 'componentes/profile/tuperfil.php';
                        }
                    }
                    ?>

                </div>

            </div>

    <?php include 'componentes/footer.php'; ?>

        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <?php include 'componentes/commonscripts.php'; ?>

</body>

</html>