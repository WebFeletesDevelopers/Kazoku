<?php
include_once 'PDO/database.php';
if (!isset($bd)) {
    $bd = crear();
}
// Esto SOLO encontara las noticias PUBLICAS
$sentencia = $bd->query('SELECT *  FROM noticias WHERE Publica >= 0 order by 1 desc;');
$noticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
if (isset($_SESSION['Rango'])) {
    if ($_SESSION['Rango'] < 2) {
        $botonAnadir = true;
    }
}
?>