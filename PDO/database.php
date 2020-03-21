<?php
function crear(){
    $user = getenv('KAZOKU_DATABASE_USER');
    $password = getenv('KAZOKU_DATABASE_PASSWORD');
    $db = getenv('KAZOKU_DATABASE_DATABASE');
    try{
        $bd = new PDO('mysql:host=db;dbname=' . $db, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $bd;
    }catch(Exception $e){
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
    }
};
function insertar (&$obj,&$bd){
    if(!isset($bd)){
        $bd = crear();
    }
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
    //$array = "[".$parameters."]";
    $sql = 'INSERT INTO'.' ';
    $sql .=$objName;
    $sql .= ' VALUES (';
    $sql .= $inter.')';
    echo $sql;
    echo var_dump($array);
    echo $parameters;
    $sentencia = $bd->prepare($sql);
    $resultado = $sentencia->execute($array);
    return $resultado;
};
function selectOne($table_name){
    $sql = 'SELECT * FROM '.$table_name.';';
    if(!isset($bd)){
        $bd = crear();
    }
    $sentencia = $bd->query($sql);
    $resultado = $sentencia->fetchObject();
    return $resultado;
}

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
// INSERT INTO nombre_tabla VALUES (?,?,?)
// si no es un numero, te pone 'valor'
    $sentencia = $bd->prepare($sql);
    $resultado = $sentencia->execute($obj->$idName);
    echo var_dump($resultado);
    if($resultado === TRUE) return TRUE;
    else return FALSE;
};

?>
