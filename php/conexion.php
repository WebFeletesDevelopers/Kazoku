<?php
$host="bbdd.albertogomp.es";
$user="NONE";
$password="NONE";
$db="NONE";
$con = new mysqli($host,$user,$password,$db);
$con->set_charset('utf8');
/*try{
    $con2 = new PDO("mysql:host=$host;dbname=$db,$user,$password");
} catch (PDOException $except){
    echo "No se ha podido establecer la conexión.<br>";
    dis("*Error:".$except->getMessage());
}*/
?>