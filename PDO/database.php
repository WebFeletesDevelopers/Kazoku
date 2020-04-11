<?php

/**
 * Creates the database connection
 * Crea la conexión a la base de datos
 * @return PDO
 */
function create(){
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
 * Generic method to insert any kind of objectToInsert in database througth PDO parsing as parameter the objectToInsert and a PDO connection. It has to be an objectToInsert witch is structured as its reference table.
 * Método genérico de inserción de objectToInsert en bases de datos mediante PDO pasando un objectToInsert por parámetro. Tiene que ser un objectToInsert que coincida 100% con la tabla correspondiente
 * @param $objectToInsert objectToInsert The objectToInsert to insert at BD / es el objectToInsert a insert en la base de datos
 * @param $BDConnection PDO The connection to BD / es la conexión a la Base de datos
 * @return bool If the insertion was succesfully done / si se realizó la insercción correctamente
 */
function insert (&$objectToInsert, $BDConnection){

    $parameters = '';
    $interrogations = "";
    $objetoEnArray =(array) $objectToInsert;

    foreach ($objetoEnArray as $field) {

        if($field !== null){
            $datePattern="/[1-9][0-9]{3}-(0[1-9]|1[0-2])-([012][1-9]|3[01])/";
            if(preg_match($datePattern, $field, $matches) === 1 && $matches[0] === $field){ //  Checks that objectToInsert matches the pattern YYYY-MM-DD - Comprueba que el objectToInsert coincide con el patrón YYYY-MM-DD
                $parameters .= $field . 'Ç';
                $interrogations.= '?,';
            }
            else {
                if(is_numeric($field)) {
                    $parameters .= $field . 'Ç';
                    $interrogations.="?,";
                }
                else{ // If is a normal string -  Si es una cadena de texto normal
                    $parameters .= $field."Ç";
                    $interrogations.="?,";
                }
            }
        }
        else if($field === null){
            $parameters .= "Ç";
            $interrogations.="?,";
        };
        // Concatenates a n number of interrogations depending of the array's positions -  Concatena un numero n de interrogations en función de las posiciones del array.
    }

    $tableName = get_class($objectToInsert);

    $interrogations =rtrim($interrogations,",");

    // Deletes the last " , " that puts the foreach and separates in a new array - Retiramos la última " , " que pone el foreach y se separa en un nuevo array
    $parameters = rtrim($parameters,"Ç ");
    $queryData = explode("Ç",$parameters);

    // Query fix - Arregla la query
    $query = 'INSERT INTO'.' ';
    $query .=$tableName;
    $query .= ' VALUES (';
    $query .= $interrogations.')';

    // Prepares the sentence and do the insert - Prepara la sentence e inserta
    $sentence = $BDConnection->prepare($query);
    return $sentence->execute($queryData);
};

/**
 * Select a row from the database - Selecciona una entrada de la base de datos.
 * @param $table_name
 * @return mixed
 */
function selectOne($table_name){
    $sql = 'SELECT * FROM '.$table_name.';';
    if(!isset($bd)){
        $bd = create();
    }
    $sentence = $bd->query($sql);
    return $sentence->fetchObject();
}


/**
 * Deletes any entry from the Database - Elimina cualquier entrada de la base de datos.
 * @param $obj
 * @param $idName
 * @return bool
 */
function borrar(&$obj,$idName){
    if(!isset($bd)){
        $bd = create();
    }
    else{
        $bd = create();

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
