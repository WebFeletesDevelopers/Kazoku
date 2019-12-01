<?php
/**
 * OPERACIONES CRUD API TASK
 * 0 -  Listar
 * 1 - Insertar
 * 2 - Borrar
 * 3 - Update
 */

$accion = $_GET["accion"];
if(is_null($accion)){
    $data = [
        "cod" => 2,
        "mensaje" => "Código de operación no definido.",
    ] ;
    include_once "html.php";
}
else{
    require_once "api.php";
    switch ($accion){
        case 0:
            $data = mostrarTodo();

            break;
        case 1:
            $Name = $_GET["Name"];
            $Progress = $_GET["Progress"];
            $Comments = $_GET["Comments"];
            //$DeathLine = $_GET["DeathLine"];
            $data = insertarTask($Name,$Progress,$Comments,null);
            break;

        case 2:
            $TaskCode = $_GET["TaskCode"];
            $data = borrarTask($TaskCode);
            break;
        case 3:
            $TaskCode = $_GET["TaskCode"];
            $Name = $_GET["Name"];
            $Progress = $_GET["Progress"];
            $Comments = $_GET["Comments"];
            $data = modificar($TaskCode,$Name,$Progress,$Comments);

            break;
        default:
            $data = [
                "Codigo" => 0,
                "mensaje" => "Código de operación incorrecto.",
            ] ;

    }
    //echo var_dump($data);
    header("Content-Type: application/json") ;
echo json_encode($data) ;
    //echo  print_r($data);
}


