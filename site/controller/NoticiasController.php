<?php
include_once '../../PDO/database.php';
include_once '../../PDO/noticias.php';

/**$noticia = new noticias();
$noticia->setTitulo("Holita");
$noticia->setCuerpo("Holita");
$noticia->setCodAutor("1");
$noticia->setPubllica("1");
enviarNoticia($noticia);
 */

/**
 * Método para recuperar las noticias
 * @param $tipo int  obtener las públicas 0, públicas y privadas 1.
 */
function buscarNoticias($tipo){
    $bd = crear();
    $sql = 'SELECT *  FROM noticias WHERE Publica >= '.$tipo.'   order by 1 desc;';
    $sentencia = $bd->query($sql);
    $noticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if (isset($_SESSION['Rango'])) {
        if ($_SESSION['Rango'] < 2) {
            $botonAnadir = true;
        }
    }
    return $noticias;
}

//TODO: El objeto noticias deberia ser noticia y cambiarse este método a una colección, pero como en la base de datos la tabla es noticias hay ahí complicación
/** Envia una noticia a la base de datos
 * @param $noticia
 * @return mixed
 */
function enviarNoticia($noticia){
    $bd = crear();
    $result = insertar($noticia,$bd);
    return ($result);
}

?>