<?php
session_start();

if(!isset($_SESSION['Rango'])){
    header('Location: ./login.php');
}
include_once 'PDO/database.php';
include_once 'site/controller/PerfilController.php';
?>

<!DOCTYPE html>
<html>

<head>

    <title>Perfil - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
    <div id="wrapper">
         <?php include 'componentes/nav.php'; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include 'componentes/navbar.php'; ?>

                <div class="container-fluid">
                    <?php
                    if($_SESSION['Rango']<2 && isset($_GET['CodAlumno'])){
                        include 'componentes/profile/ID.php';
                    }else{
                        if($_SESSION['Alta']==false) {
                            include 'componentes/profile/noperfil.php';
                        }
                        else{
                            include 'componentes/profile/tuperfil.php';
                        }
                    }
                    ?>

                </div>

            </div>

    <?php include 'componentes/footer.php'; ?>

        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <?php include 'componentes/commonscripts.php'; ?>

</body>

</html>