<?php

/**
 * Crea la conexión a la base de datos
 * @return PDO
 */
function crear(){
    $contrasena = "devel";
    $usuario = "root";
    $nombre_base_de_datos = "kazoku";
    try{
        $bd = new PDO('mysql:host=db;dbname=' . $nombre_base_de_datos, $usuario, $contrasena,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $bd;
    }catch(Exception $e){
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
    }
};

/**
 * Inserta cualquier objeto en la base de datos
 * @param $obj
 * @param $bd
 */
function insertar (&$obj,$bd){
    $parameters = '';
    $inter = "";
    $objArray =(array) $obj;

    foreach ($objArray as $valor) {
        if(!isset($valor)){
            $parameters .= ' , ';
        }
        else{
            if(is_numeric($valor)) {
                $parameters .= $valor . ', ';
            }
            else{
                $parameters .= $valor.", "; }

        }
        $inter.="?,";
    }

    $objName = get_class($obj);
    $inter =rtrim($inter,",");
    $parameters = rtrim($parameters,", ");
    $array = explode(",",$parameters);
    $sql = 'INSERT INTO'.' ';
    $sql .=$objName;
    $sql .= ' VALUES (';
    $sql .= $inter.')';
    $sentencia = $bd->prepare($sql);
    $resultado = $sentencia->execute($array);
    return $resultado;
};

/**
 * Selecciona una entrada de la base de datos.
 * @param $table_name
 * @return mixed
 */
function selectOne($table_name){
    $sql = 'SELECT * FROM '.$table_name.';';
    if(!isset($bd)){
        $bd = crear();
    }
    $sentencia = $bd->query($sql);
    $resultado = $sentencia->fetchObject();
    return $resultado;
}


/**
 * Elimina cualquier entrada de la base de datos.
 * @param $obj
 * @param $idName
 * @return bool
 */
function borrar(&$obj,$idName){
    if(!isset($_SESSION['bd'])){
        $bd = crear();
    }
    else{
        $bd = crear();

    }
    $objName = get_class($obj);
    $sql = 'DELETE  FROM'.' ';
    $sql .=$objName;
    $sql .= 'WHERE '.$idName.' = ?';
    $sentencia = $bd->prepare($sql);
    $resultado = $sentencia->execute($obj->$idName);
    echo var_dump($resultado);
    if($resultado === TRUE) return TRUE;
    else return FALSE;
};

?>
