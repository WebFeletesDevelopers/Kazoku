<?php
if(!isset($_GET['Code'])){
    if($_SESSION['Code']===''){
        echo "fail";
    }
}else{
    include "form/config.php";

    $token = mysqli_real_escape_string($con,substr($_GET['Code'],0,32));
    $user = mysqli_real_escape_string($con,substr($_GET['Code'],32));
    if ($user != "" && $token !== "" ){
        $sql_query = "UPDATE `Verification` SET `confirmado` = 1 WHERE `Uname` like('$user') AND `Code` like('$token');";
        $result = mysqli_query($con,$sql_query);
        $sql_query = "UPDATE `users` SET `EmailConfirmado` = 1 WHERE `username` like('$user');";
        $result = mysqli_query($con,$sql_query);
    }
}



if(!isset($_SESSION['name'])){
    header('Location: ../../../login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Verificar - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>

            <div class="container-fluid">

                <!-- Start: Chart -->
                <div class="jumbotron">
                    <h1 class="display-4">Hola!</h1>
                    <p class="lead">Gracias por confirmar tu cuenta</p>
                    <hr class="my-4">
                    <p>En estos momentos estamos verificando tu identidad</p>
                    <a class="btn btn-primary btn-lg" href="index.php" role="button">Ir al inicio</a>
                </div>
                <!-- End: Chart -->
                <div class="row">
                    <div class="col-lg-6 mb-4">


                    </div>

                </div>
            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
</body>

</html>