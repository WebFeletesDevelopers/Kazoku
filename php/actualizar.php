<?php

if(!empty($_POST)){
	if(isset($_POST["Nombre"]) &&isset($_POST["Apellido1"]) &&isset($_POST["Apellido2"]) &&isset($_POST["Sexo"])){
		if($_POST["Nombre"]!=""&& $_POST["Apellido1"]!=""){
			include "conexion.php";
			$CodAlumno = $_POST["CodAlumno"];
            $Nombre = $_POST["Nombre"];
            $Apellido1 = $_POST["Apellido1"];
            if($_POST["Apellido2"]!=""){
                $Apellido2 = $_POST["Apellido2"];
            }
            else{
                $Apellido2 = null;
            }
            $Sexo = null;
            switch ($_POST["Sexo"]){
                case 1:
                case "Masculino" :
                    $Sexo = 1;
                    break;
                case 0:
                case "Femenino":
                    $Sexo = 0;
                    break;
                default:
                    $Sexo = 1;
            }
            if(isset($_POST["IdFanjyda"])){
                $IdFanjyda = $_POST["IdFanjyda"];
            }
            else{
                $IdFanjyda = null;
            }
            if(isset($_POST["DNI"])){
                $DNI = $_POST["DNI"];
            }
            else{
                $DNI = null;
            }
            $date = DateTime::createFromFormat('d/m/Y', $_POST["FechaNacimiento"])->getTimestamp();
            $newDate = date("Y-m-d", $date);

            /*            $sql = "insert into alumno (Nombre,Apellido1,Apellido2,Sexo,IdFanjyda,DNI,FechaNacimiento) values ('$Nombre','$Apellido1','$Apellido2','$Sexo','$IdFanjyda','$DNI','$newDate');";*/

            $sql = "update alumno set values (Nombre=$Nombre,Apellido1=$Apellido1,Apellido2=$Apellido2,Sexo=$Sexo,IdFanjyda=$IdFanjyda,DNI=$DNI,FechaNacimiento=$newDate) where (CodAlumno=$CodAlumno)";
			$query = $con->query($sql);
			if($query!=null){
				print ");window.location='../../ver.php';</script>";
			}else{
				print ");window.location='../../ver.php';</script>";

			}
		}
	}
}
else{
    print ");window.location='../../ver.php';</script>";

}



?>