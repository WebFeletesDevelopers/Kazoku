<?php
include_once "database.php";

        $primaryKey = $_POST["pk"];
        $primaryKeyValue = $_POST["pkv"];
        $objName = get_class($_POST["obj"]);

        $sql = "DELETE FROM ";
        $sql .=$objName;
        $sql .= ") WHERE ";
        $sql .= $primaryKey;
        $sql .= "= ".$primaryKeyValue;
        $sentencia = $bd->prepare($sql);
        $resultado = $sentencia->execute();
        if($resultado === TRUE) echo "eliminado correctamente";
        else echo "Algo salió mal.";


        ?>

