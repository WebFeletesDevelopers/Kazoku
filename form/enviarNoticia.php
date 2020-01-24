<?php
session_start();

include "config.php";

$cuerpo = mysqli_real_escape_string($con,$_POST['cuerpo']);
$publico = mysqli_real_escape_string($con,$_POST['publico']);
$titulo = mysqli_real_escape_string($con,$_POST['titulo']);
$Autor = mysqli_real_escape_string($con,$_POST['Autor']);

if ($cuerpo != "" && $publico !="" && $titulo !=""){
        $sql_query = "INSERT INTO noticias (`Titulo`,`Cuerpo`,`Autor`,`Publica`) VALUES ('$titulo','$cuerpo','$Autor','$publico');";
        $result = mysqli_query($con,$sql_query);
        if($result){
            echo 1;
        }
        else{
            echo 0;
        }


}
else{
    echo 0;
}