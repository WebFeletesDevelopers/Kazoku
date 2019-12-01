<?php

require_once("todo.php");
function crear(){
    $contrasena = "NONE";
    $usuario = "NONE"; // --> ALBERTO DEL FUTURO, CAMBIA EL NOMBRE DE LA BD O TE COMES UNA ROSCA
    $nombre_base_de_datos = "NONE";
    try{
        $bd = new PDO('mysql:host=bbdd.albertogomp.es;dbname=' . $nombre_base_de_datos, $usuario, $contrasena,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $bd;
    }catch(Exception $e){
        return "Ocurrió algo con la base de datos: " . $e->getMessage();
    }

};

function mostrarTodo(){
    $todoArray = new todo();
    $bd = crear();
    $sql = "SELECT * FROM todo";
    $listar = $bd->query($sql);
    $todoArray = $listar->fetchAll(PDO::FETCH_OBJ);
    $return = [];

    if(count($todoArray)>0){
        foreach($todoArray as $task){
            $tasks = [
                'TaskCode' => $task->TaskCode,
                'Name' => $task->Name,
                'Progress' => $task->Progress,
                'Comments' => $task->Comments,
                'DeathLine' => $task->DeathLine
            ];
            $return[] = $tasks;
        }
    }
    else{

    }
    return $return;
}
function insertarTask($Name,$Progress,$Comments,$DeathLine){
    $sql = 'INSERT INTO todo VALUES(?,?,?,?,?)';
    $bd = crear();
    $insert = $bd->prepare($sql);
    $result = $insert->execute([null,$Name,$Progress,$Comments,$DeathLine]);
    if($result){
        $res = [
            "Codigo" =>0,
            "mensaje" => "Insertado con éxito",
        ] ;
    }
    else{
        $res = [
            "Codigo" => 3,
            "mensaje" => "ERROR: Parametros incorrectos.",
        ] ;
    }
    return $res;

}
function borrarTask($TaskCode){

    $sql = 'DELETE FROM todo WHERE TaskCode = ?';
    $bd = crear();
    $delete= $bd->prepare($sql);
    $result = $delete->execute([$TaskCode]);
    if($result){
        $res = [
            "Codigo" => 0,
            "mensaje" => "Borrado satisfactorio",
        ] ;
    }
    else{
        $res = [
            "Codigo" => 5,
            "mensaje" => "ERROR: No encontrado.",
        ] ;
    }
    return $res;
}
function modificar($TaskCode,$Name,$Progress,$Comments){
    $sql = 'SELECT * FROM todo where TaskCode ='.$TaskCode;
    $bd = crear();
    $update = null;
    if(is_numeric($TaskCode)){
        $getTask = $bd->query($sql);
        $result = $getTask->fetchObject();
        $update = "";
        echo var_dump($result);
        if($result->Name != $Name){
            $update .= "Name = '$Name', ";
            echo "holita";
        }
        if($result->Progress != $Progress){
            $update .=  "Progress = '$Progress', ";
        }
        if($result->Comments != $Comments){
            $update .= " Comments = '$Comments', ";
        }
        if($result->DeathLine != ""){
           // $update = "DeathLine";
        }

        $update = rtrim($update,", ");
        if($update !== null){
            $sql = 'UPDATE todo SET '.$update.'  WHERE TaskCode = '.$TaskCode;
            $UpdateTable = $bd->query($sql);
            $resultado = $UpdateTable->execute();

            if($resultado){
                $result = [
                    "Codigo" => 0,
                    "mensaje" => "Insertado correctamente.",
                ] ;
            }
        }

        else{
            $result = [
                "Codigo" => 3,
                "mensaje" => "ERROR: Parametros incorrectos.",
            ] ;
        }
    }
    return $result;
}

?>