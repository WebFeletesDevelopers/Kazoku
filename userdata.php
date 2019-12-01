<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../../login.php');
}
else {
    include 'php/conexion.php';
}


$Range = $_SESSION['Rango'];
switch ($Range){
    case 0:
        $Range = 'Administrador';
        break;
    case 1:
        $Range = 'Profesor';
        break;
    case 2:
        $Range = 'Alumno';
        break;
    case 3:
        $Range = 'Tutor';
        break;
    default:
        $Range = "N/A";
}

?>
<!DOCTYPE html>
<html>

<head>

    <title>Profile - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>

            <div class="container-fluid">
                <h3 class="text-dark mb-4">Tus datos</h3>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">


                        </div>

                    </div>
                    <div class="col-lg-12">
                        <?php
                        if($_SESSION['EmailConfirmado']==0){
                            echo '<div class="alert alert-danger text-center" role="alert">Tu email no está confirmado</div>';
                        }
                        if($_SESSION['Confirmado']==0){
                            echo '<div class="alert alert-warning text-center" role="alert">Tu cuenta no está confirmada</div>';
                        }
                        ?>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold"><?= $Range ?></p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="username"><strong>Nombre de Usuario</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['name']?>" name="username"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Tu correo</strong></label><input class="form-control" type="email" placeholder="<?= $_SESSION['Email']?>" name="email"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>Tu nombre</strong></label><input class="form-control" type="text" placeholder="<?= $_SESSION['Nombre']?>" name="first_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Apellido(s)</strong></label><input class="form-control" type="text" placeholder='<?= $_SESSION['Apellido1']?> <?= $_SESSION['Apellido2']?> ' name="last_name"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Actualizar datos</button> <small>tendrás que volver a iniciar sesión si los cambias...</small></div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>

    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<?php include 'componentes/commonscripts.php'; ?>

</body>

</html>