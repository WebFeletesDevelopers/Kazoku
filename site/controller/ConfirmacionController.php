<?php
session_start();
if (isProfe() || isAdmin()) {
} else {
    header('Location: ../../../login.php');
}
include_once 'PDO/database.php';

$username = $_POST['username'];
$action = $_POST['action'];

if ($username != "" && $action == "confirmar") {
    //$result = mysqli_query($con, $sql_query);
    //$row = mysqli_fetch_array($result);
    if(!isset($bd)) {
        $bd =  create();
    }
    $sql_query = "UPDATE `users` SET `Confirmado` = 1 WHERE `username` like('$username');";
    $sentence = $bd->prepare($query);
    $success = $sentence->execute();
    if ($success) {
        echo 0;
    } else {
        echo 1;
    }

} else if ($username != "" && $action == "borrar") {
    $query = "DELETE FROM `users` WHERE `username` like('$username');";
    $sentence = $bd->prepare($query);
    $success = $sentence->execute();
    if ($success) {
        echo 0;
    } else {
        echo 1;
    }
}
