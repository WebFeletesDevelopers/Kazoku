<?php
include_once "database.php";
        $parameters = '';
        $inter = "";
        $objArray =(array) $_POST["obj"];
        $primaryKey = $_POST["pk"];
        $primaryKeyValue = $_POST["pkv"];

        foreach ($objArray as $valor) {
            if($valor=== ''){
                $parameters .= 'NULL, ';
            }
            else{
                if(is_numeric($valor)) {
                    $parameters .= $valor . ', ';
                }
                else{
                    $parameters .= "'".$valor."', "; }

            }
            $inter.="?,";
        }

        $objName = get_class($_POST["obj"]);
        $inter =rtrim($inter,",");
        $parameters = rtrim($parameters,", ");
        $sql = "UPDATE ";
        $sql .=$objName;
        $sql .= "SET (";
        $sql .= $inter;
        $sql .= ") WHERE ";
        $sql .= $primaryKey;
        $sql .= "= ".$primaryKeyValue;
        $sentencia = $bd->prepare($sql);
        $resultado = $sentencia->execute($parameters);
        if($resultado === TRUE) echo "modificado correctamente";
        else echo "Algo salió mal.";
?>

