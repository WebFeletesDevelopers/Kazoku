<?php
session_start();
$_SESSION = [];
session_destroy();
session_unset();
mysqli_close();
header('Location: ../../index.php');
?>