<?php
session_start();
if(isProfe() || isAdmin()){
}
else{
    header('Location: ../../../login.php');
}
include_once 'PDO/database.php';
$user_id=null;
$orden="Apellido1, Apellido2";


function asignarCinturon($CodCinturon)
{
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

$bd =crear();
$sentencia = $bd->query("SELECT * FROM alumno order by $orden;");
$alumno = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
