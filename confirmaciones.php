<?php
session_start();
if(!isset($_SESSION['name']) || !isset($_SESSION['Rango']) ){
    header('Location: ../../../login.php');
}
if ($_SESSION['Rango']>=2  ){
    header('Location: ../../../login.php');
}
if ($_SESSION['Confirmado']!=1){
    header('Location: ../../../login.php');
}
$user_id=null;
$orden="Apellido1, Apellido2";
/*if($_GET[s]!==null){
    $orden=$_GET[s];
}*/


include_once 'PDO/database.php';
if(!isset($bd)){
    $bd = create();
}
$sentencia = $bd->query("SELECT * FROM users where `Confirmado`=0 order by `Apellido1`;");
$users = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <title>Confirmaciones - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>
<body id="page-top" class="">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content " >
            <?php include 'componentes/navbar.php'; ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Confirmaciones</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Cuentas de usuario</p>
                    </div>
                    <?php if(count($users)>0):?>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <?php include 'php/finder.php'; ?>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($users as $usu ){
                                    ?>
                                    <tr>
                                        <td id="username"><?= $usu->username; ?></td>
                                        <td><?= $usu->name; ?></td>
                                        <td><?= $usu->Apellido1.' '.$usu->Apellido2; ?> </td>
                                        <td><?= $usu->Telefono; ?></td>
                                        <td><?= $usu->Email; ?></td>
                                        <td class="text-center">
                                            <div id="message"></div>
                                            <button class="btn-primary btn" onclick='mod("<?= $usu->username?>","<?= "confirmar"?>")' id="confirmar" value="<?= $usu->username; ?>">Confirmar</button>
                                            <button class="btn-danger btn" onclick='mod("<?= $usu->username?>","<?= "borrar"?>")' id="borrar" value="<?= $usu->username; ?>">Borrar</button>
                                        </td>

                                    </tr>
                                <?php };?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th></th>

                                </tr>
                                </tfoot>
                            </table>
                            <?php else:?>
                                <p class="alert alert-warning">No hay resultados</p>
                            <?php endif;?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
        <script>
            $(document).ready(function(){


            });
            function mod($username, $accion){


                if( $accion != ""){
                    $.ajax({
                        url:'./controller/ConfirmacionController.php',
                        type:'post',
                        data:{username:$username,action:$accion},
                        success:function(response){
                            var msg = "";
                            if(response != 0){
                                msg = "Confirmado con éxito";

                                $("#dataTable").load(location.href + " #dataTable");

                            }else{
                                msg = "Error";
                            }
                            $("#message").html(msg);
                        }
                    });


                }
            };
        </script>
</body>

</html>