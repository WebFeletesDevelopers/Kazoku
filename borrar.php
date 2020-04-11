<?php
include_once 'PDO/database.php';
session_start();
if(!isset($_SESSION['name']) || !isset($_SESSION['Rango']) ){
    header('Location: ../../../login.php');
}
if ($_SESSION['Rango']>=2  ){
    header('Location: ../../../login.php');
}
if ($_SESSION['Confirmado']!=1){
    header('Location: ../../../login.php');
}
if(!isset($bd)){
    $bd = create();
}

$id = $_GET["CodNot"];
$sentencia = $bd->exec('DELETE FROM noticias WHERE CodNot = ' .$id);
header('Location: ../../../index.php');

?>


?>