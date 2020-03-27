<?php
session_start();
include 'ClasesController.php';
if(isProfe() || isAdmin()){
}
else{
    header('Location: ../../../login.php');
}

$user_id=null;
$orden="Apellido1, Apellido2";






?>
