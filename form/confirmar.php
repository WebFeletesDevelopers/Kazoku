<?php
session_start();
if(!isset($_SESSION['Rango'])){
    if($_SESSION['Rango']>=2){
        echo 1;
    }
}else{
    include "config.php";

    $uname = mysqli_real_escape_string($con,$_POST['username']);
    $accion = mysqli_real_escape_string($con,$_POST['action']);

    if ($uname != "" && $accion == "confirmar" ){
        $sql_query = "UPDATE `users` SET `Confirmado` = 1 WHERE `username` like('$uname');";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        if($row > 0){
            echo 0;
        }else{
            echo 1;
        }

    } else if ($uname != "" && $accion == "borrar" ){
        $sql_query = "DELETE FROM `users` WHERE `username` like('$uname');";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        if($row > 0){
            echo 0;
        }else{
            echo 1;
        }

    };
}
