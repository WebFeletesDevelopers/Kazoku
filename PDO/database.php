<?php

/**
 * Crea la conexión a la base de datos
 * @return PDO
 */
function crear(){
    $user = getenv('KAZOKU_DATABASE_USER');
    $password = getenv('KAZOKU_DATABASE_PASSWORD');
    $db = getenv('KAZOKU_DATABASE_DATABASE');
    try{
        $bd = new PDO('mysql:host=db;dbname=' . $db, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $bd;
    }catch(Exception $e){
        echo 'Ocurrió algo con la base de datos: ' . $e->getMessage();
        return null;

    }
}

/**
 * Método genérico de inserción de objeto en bases de datos mediante PDO pasando un objeto por parámetro. Tiene que ser un objeto que coincida 100% con la tabla correspondiente
 * @param $objeto object es el objeto a insertar en la base de datos
 * @param $conexionBD PDO es la conexión a la Base de datos
 * @return bool si se realizó la insercción correctamente
 */
function insertar (&$objeto,$conexionBD){

    $parametros = '';
    $interrogaciones = "";
    $objetoEnArray =(array) $objeto;

    foreach ($objetoEnArray as $campoObjeto) {

        if($campoObjeto !== null){
            $patronFecha="/[1-9][0-9]{3}-(0[1-9]|1[0-2])-([012][1-9]|3[01])/";
            if(preg_match($patronFecha, $campoObjeto, $matches) === 1 && $matches[0] === $campoObjeto){ // Comprueba que el objeto coincide con el patrón YYYY-MM-DD
                $parametros .= $campoObjeto . 'Ç';
                $interrogaciones.= '?,';
            }
            else {
                if(is_numeric($campoObjeto)) {
                    $parametros .= $campoObjeto . 'Ç';
                    $interrogaciones.="?,";
                }
                else{ // Si es una cadena de texto normal
                    $parametros .= $campoObjeto."Ç";
                    $interrogaciones.="?,";
                }
            }
        }
        else if($campoObjeto === null){
            $parametros .= "Ç";
            $interrogaciones.="?,";
        };
        // Concatena un numero n de interrogaciones en función de las posiciones del array.
    }

    $nombreTabla = get_class($objeto);

    $interrogaciones =rtrim($interrogaciones,",");

    // Retiramos la última " , " que pone el foreach y se separa en un nuevo array
    $parametros = rtrim($parametros,"Ç ");
    $datosConsulta = explode("Ç",$parametros);

    // Arregla la query
    $consulta = 'INSERT INTO'.' ';
    $consulta .=$nombreTabla;
    $consulta .= ' VALUES (';
    $consulta .= $interrogaciones.')';

    // Prepara la sentencia e inserta
    $sentencia = $conexionBD->prepare($consulta);
    return $sentencia->execute($datosConsulta);
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
    return $sentencia->fetchObject();
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
    if($resultado === TRUE) return TRUE;
    else return FALSE;
};

?>
