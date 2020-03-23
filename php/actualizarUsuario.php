<?php
include "config.php";

$Nombre = mysqli_real_escape_string($con,$_POST['Nombre']);
$Apellido1 = mysqli_real_escape_string($con,$_POST['Apellido1']);
$Direccion = mysqli_real_escape_string($con,$_POST['Direccion']);
$CodPostal = mysqli_real_escape_string($con,$_POST['CodPostal']);


if ($Nombre !== '' && $Apellido1 !== '' && $Direccion !== '' && $CodPostal !== ''){

    $sql1 = 'select CodDireccion from alumno where CodUsu = '.$_SESSION['CodUsu'];
    $query = mysqli_query($con,$sql1);
    $sql_query = "INSERT INTO alumno (`Nombre`,`Apellido1`) VALUES ('$Nombre','$Apellido1') users WHERE username='".$_SESSION['name']."';";
    $sql_query.= " INSERT INTO direccion (`Direccion`,`CodPostal`) VALUES('$Direccion','$CodPostal') WHERE `CodDireccion` =''".$query."''";
    $result = mysqli_query($con,$sql_query);
    if(is_null($result)){
        echo 0;
    }else{
        echo 1;
    }
}
?>