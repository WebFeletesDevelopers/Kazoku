<?php

$host="bbdd.albertogomp.es";
$user="NONE";
$password="NONE";
$dbname="NONE";
if(isset($con)){
    $con->close();
}
$con = mysqli_connect($host, $user, $password,$dbname);
$con->set_charset('utf8');

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}