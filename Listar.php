<?php
$listadoAlumnos = [];
include 'site/controller/SessionController.php';
include 'site/controller/ClasesController.php';

if(isProfe() || isAdmin()){
}
else{
    header('Location: ../../../login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Alumnos - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: green;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: red;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px red;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>
<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <div class="container-fluid p-0 m-0">
                <div class="card m-0 p-0 shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Club de Judo Kazoku <?php if(!is_null($claseActual->Nombre)){ echo ' - '.$claseActual->Nombre;} else{ echo 'null';}  ?></p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <?php include 'php/finder.php'; ?>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <?php if(count($listadoAlumnos)>0):?>

                                <table class="table dataTable my-0" id="tablaAlumnos">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Presente</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($listadoAlumnos as $alu){
                                        $originalDate = $alu->FechaNacimiento;
                                        $newDate = date("d/m/Y", strtotime($originalDate));
                                        ?>
                                        <tr>
                                            <td><img src="/assets/img/profile/<?php if(file_exists("assets/img/profile/".$alu->DNI.'.png')){echo $alu->DNI;}else{echo "generic";}  ?>.png" width="30" height="30"></td>
                                            <td><?= $alu->Nombre; ?></td>
                                            <td><?= $alu->Apellido1.' '.$alu->Apellido2; ?> </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" id="<?=$alu->CodAlumno?>" onClick="aLaLista(this.id);"  >
                                                    <span class="slider round"></span>
                                                </label>


                                            </td>
                                        </tr>
                                    <?php }?>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Presente</th>
                                    </tr>
                                    </tfoot>
                                </table>

                                <button class="btn btn-primary" onclick="mandarLista()">ENVIAR</button>

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
        <?php
        include 'componentes/footer.php';
        include 'componentes/commonscripts.php';
        include 'site/js/ScriptPasarLista.php';
        ?>
</body>

</html>