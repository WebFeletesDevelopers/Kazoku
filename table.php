<?php
include 'site/controller/SessionController.php';
include 'site/controller/ListadoController.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Alumnos - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>
<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Alumnado</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Club de Judo Kazoku</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <?php include 'php/finder.php'; ?>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <?php if(count($alumno)>0):?>

                                <table class="table dataTable my-0" id="tablaAlumnos">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Sexo</th>
                                    <th>Cinturón</th>
                                    <th>ID Fanjyda</th>
                                    <th>DNI/NIE/PAS</th>
                                    <th>Info</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($alumno as $alu){
                                    $originalDate = $alu->FechaNacimiento;
                                    $newDate = date("d/m/Y", strtotime($originalDate));
                                    ?>
                                    <tr>
                                        <td><img src="/site/images/profile/<?php if(file_exists("site/images/profile/".$alu->DNI.'.png')){echo $alu->DNI;}else{echo "generic";}  ?>.png" width="30" height="30"></td>
                                        <td><?= $alu->Nombre; ?></td>
                                        <td><?= $alu->Apellido1.' '.$alu->Apellido2; ?> </td>
                                            <td><?= $newDate  ?></td>
                                        <td><?php if($alu->Sexo==1){echo "Masculino";}else{echo "Femenino";}?></td>
                                        <td><?php  if(isset($alu->CodCinturon)){ echo asignarCinturon($alu->CodCinturon);} else{ echo "Blanco";}?></td>
                                        <td><?= $alu->IdFanjyda; ?></td>
                                        <td><?= $alu->DNI; ?></td>
                                        <td><a href="profile.php?CodAlumno=<?=$alu->CodAlumno?>" class="container-fluid btn btn-sm btn-primary inline-block m-1"><i class="fas fa-user-tag"></i></a></td>
                                    </tr>

                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Cinturón</th>
                                        <th>ID Fanjyda</th>
                                        <th>DNI/NIE/PAS</th>
                                        <th>Info</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php else:?>
                                <p class="alert alert-warning">No hay resultados</p>
                            <?php endif;?>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">>></span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
</body>

</html>