<?php
$host = 'db';
$user = getenv('KAZOKU_DATABASE_USER');
$password = getenv('KAZOKU_DATABASE_PASSWORD');
$db = getenv('KAZOKU_DATABASE_DATABASE');
$con = new mysqli($host,$user,$password,$db);
$con->set_charset('utf8');
/*try{
    $con2 = new PDO("mysql:host=$host;dbname=$db,$user,$password");
} catch (PDOException $except){
    echo "No se ha podido establecer la conexión.<br>";
    dis("*Error:".$except->getMessage());
}*/
