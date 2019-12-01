<?php


if(!empty($_POST)){
	if(isset($_POST["Nombre"]) &&isset($_POST["Apellido1"]) &&isset($_POST["Sexo"]) &&isset($_POST["FechaNacimiento"])){
		if($_POST["Nombre"]!="" && $_POST["Apellido1"]!="" && $_POST["FechaNacimiento"]!=""){
			include "conexion.php";
            $Nombre = $_POST["Nombre"];
            $Apellido1 = $_POST["Apellido1"];
            if(isset($_POST["Apellido2"])){
                $Apellido2 = $_POST["Apellido2"];
            }
            else{
                $Apellido2 = null;
            }

            $Sexo = null;
            switch ($_POST["Sexo"]){
                case 1:
                case "MASCULINO":
                case "masculino":
                case "m":
                case "Masculino" :
                    $Sexo = 1;
                    break;
                case 0:
                case "femenino":
                case "f":
                case "FEMENINO":
                case "Femenino":
                    $Sexo = 0;
                    break;
                default:
                    $Sexo = 1;
            }
            if(isset($_POST["DNI"])){
                $DNI = $_POST["DNI"];
            }
            else{
                $DNI = null;
            }
            if(isset($_POST["IdFanjyda"])){
                $IdFanjyda = $_POST["IdFanjyda"];
            }
            else{
                $IdFanjyda = null;
            }
            if(isset($_POST["Telefono"])){
                $Telefono = $_POST["Telefono"];
            }
            else{
                $Telefono = null;
            }
            if(isset($_POST["Email"])){
                $Email = $_POST["Email"];
            }
            else{
                $Email = null;
            }
            if(isset($_POST["Enfermedad"])){
                $Enfermedad = $_POST["Enfermedad"];
            }
            else{
                $Enfermedad = null;
            }

            $date = str_replace('/', '-', $_POST["FechaNacimiento"] );
            $newDate = date("Y-m-d", strtotime($date));
            if(isset($_POST["CodUsu"])){
                $CodUsu = $_POST["CodUsu"];
            }
            else{
                $CodUsu = null;
            }
            $sql = "insert into alumno (Nombre,Apellido1,Apellido2,Sexo,IdFanjyda,DNI,FechaNacimiento,Telefono,Enfermedad,Email,CodUsu) values ('$Nombre','$Apellido1','$Apellido2','$Sexo','$IdFanjyda','$DNI','$newDate','$Telefono','$Enfermedad','$Email','$CodUsu');";
			$query = $con->query($sql);
			if($query!=null){
				print ");window.location='../../ver.php';</script>";
                print_r($_POST);

            }else{
				print ");window.location='../../ver.php';</script>";
                print_r($_POST);

            }
		}
	}
}



?>