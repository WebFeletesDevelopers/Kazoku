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
 * Método genérico de inserción de objeto en bases de datos mediante PDO pasando un objeto por parámetro. Tiene que ser un objeto que coincida 100% con la tabla correspondiente
 * @param $objeto object es el objeto a insertar en la base de datos
 * @param $conexionBD PDO es la conexión a la Base de datos
 */
function insertar (&$objeto,$conexionBD){

    $parametros = '';
    $interrogaciones = "";
    $objetoEnArray =(array) $objeto;

    foreach ($objetoEnArray as $campoObjeto) {

        if(is_null($campoObjeto)){
            $parametros .= ",";
        }
        else{

            $patronFecha="/[1-9][0-9]{3}-(0[1-9]|1[0-2])-([012][1-9]|3[01])/";
            if(preg_match($patronFecha, $campoObjeto, $matches) === 1 && $matches[0] === $campoObjeto){ // Comprueba que el objeto coincide con el patrón YYYY-MM-DD
                $parametros .= $campoObjeto . ',';
            }
            else {
                if(is_numeric($campoObjeto)) {
                    $parametros .= $campoObjeto . ',';
                }
                else{ // Si es una cadena de texto normal
                    $parametros .= $campoObjeto.",";
                }
            }
        }
        // Concatena un numero n de interrogaciones en función de las posiciones del array.
        $interrogaciones.="?,";
    }

    $nombreTabla = get_class($objeto);

    $interrogaciones =rtrim($interrogaciones,",");

    // Retiramos la última " , " que pone el foreach y se separa en un nuevo array
    $parametros = rtrim($parametros,", ");
    $datosConsulta = explode(",",$parametros);

    // Arregla la query
    $consulta = 'INSERT INTO'.' ';
    $consulta .=$nombreTabla;
    $consulta .= ' VALUES (';
    $consulta .= $interrogaciones.')';

    // Prepara la sentencia e inserta
    $sentencia = $conexionBD->prepare($consulta);
    $resultado = $sentencia->execute($datosConsulta);
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
