<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../../login.php');
}

include "php/conexion.php";

$user_id=null;
if($_GET['s']=="Masculino" || $_GET['s']=="masculino"){
    $_GET['s'] = 1;
    $sql1= "select * from alumno where Sexo like '%$_GET[s]%'";
} else if($_GET['s']=="Femenino" || $_GET['s']=="femenino"){
    $_GET['s'] = 0;
    $sql1= "select * from alumno where Sexo like '%$_GET[s]%'";
} else {
    $sql1= "select * from alumno where Nombre like '%$_GET[s]%' or Apellido1 like '%$_GET[s]%' or Apellido2 like '%$_GET[s]%' or Sexo like '%$_GET[s]%' or FechaNacimiento like '%$_GET[s]%' or DNI like '%$_GET[s]%' or IdFanjyda like '%$_GET[s]%' or CodAlumno like '%$_GET[s]%'";
}
$query = $con->query($sql1);
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
    <title>Buscar Alumnos - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>
<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Alumnado</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Club de Judo Kazoku</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <?php include 'php/finder.php'; ?>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <?php if($query->num_rows>0):?>

                                <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Cinturón</th>
                                        <th>ID Fanjyda</th>
                                        <th>DNI/NIE/PAS</th>
                                        <th>Info</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($r=$query->fetch_array()):
                                    $originalDate = $r["FechaNacimiento"];
                                    $newDate = date("d/m/Y", strtotime($originalDate));
                                    ?>
                                        <tr>
                                        <td><img src="/assets/img/profile/<?php if(file_exists("assets/img/profile/".$r['DNI'].'.png')){echo "$r[DNI]";}else{echo "generic";}  ?>.png" width="30" height="30"></td>
                                        <td><?= $r["Nombre"]; ?></td>
                                        <td><?= $r["Apellido1"].' '.$r['Apellido2']; ?> </td>
                                        <td><?= $newDate; ?></td>
                                        <td><?php if($r["Sexo"]==1){echo "Masculino";}else{echo "Femenino";}?></td>
                                        <td><?php  if(isset($r["CodCinturon"])){ echo asignarCinturon($r["CodCinturon"]);} else{ echo "Blanco";}?></td>
                                        <td><?= $r["IdFanjyda"]; ?></td>
                                        <td><?= $r["DNI"]; ?></td>
                                        <td><a href="/profile.php?CodAlumno=<?=$r["CodAlumno"]?>" class="container-fluid btn btn-sm btn-primary inline-block m-1">Info</a></td>
                                    </tr>
                                    <?php endwhile;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Cinturón</th>
                                        <th>ID Fanjyda</th>
                                        <th>DNI/NIE/PAS</th>
                                        <th>Info</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php else:?>
                                <p class="alert alert-warning">No hay resultados</p>
                            <?php endif;?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
</body>

</html>