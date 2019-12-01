<?php

if(!empty($_GET)){
			include "conexion.php";
			
			$sql = "DELETE FROM alumno WHERE CodAlumno=".$_GET["CodAlumno"];
			$query = $con->query($sql);
			if($query!=null){
				print ");window.location='../../ver.php';</script>";
			}else{
				print ");window.location='../../ver.php';</script>";

			}
}

?>