
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
?>
<html>
<head>
    <script src="https://use.fontawesome.com/e68939b961.js"></script>

    <title>Alta</title>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600%7CRoboto:400,900">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background-color: #293541">
<?php include "../php/header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include "php/formAlta.php"; ?>



        </div>
    </div>
</div>

<script src="../assets/js/core.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html><?php
