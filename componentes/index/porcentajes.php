<?php
$url = "http://taskapi.albertogomp.es/Taskapi.php";
$datos  = file_get_contents("http://nukazoku.albertogomp.es/api/Taskapi.php?accion=0") ;
$tasks = json_decode($datos);


?>
<div id="Taskapi" class="card shadow mb-4">
    <div class="card-header py-3">
        <p>
            <?php if(isset($_SESSION['Rango']) && $_SESSION['Rango']==0){
                echo '
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Añadir tarea</button>
            ';
            }
            ?>
        </p>
    </div>
    <div class="card-body">
        <?php
        if(count($tasks)==0){
            echo '<alert class="alert alert-info container">No se han encontrado tareas</alert>';
        }
        foreach ($tasks as $task) {
            ?>
            <nav class="nav container-fluid row">
                <div class="col-md-6 nav">
                    <a class="nav-link disabled" href="#"><?=$task->Name?>    </a>
                    <a class="nav-link disabled" href="#"><?=$task->Comments ?></a>
                </div>
                <div class="col-md-6 nav">
                    <?php
                    if(isset($_SESSION['Rango']) && $_SESSION['Rango']==0){
                        echo '
                        
                         <button class="borrar btn btn-danger nav-link " type="submit" data-code='.$task->TaskCode.' >
                            Borrar
                         </button>
                         <button class="actualizar btn btn-success nav-link mx-1" type="submit" data-code="'.$task->TaskCode.'" data-name="$task->Name" data-comments="'.$task->Comments.'" data-progress="'.$task->Progress.'" >
                            Actualizar
                         </button>
                        ';
                    }
                    ?>

                    <a class="nav-link disabled right" href="#"><span class="float-right"><?=$task->Progress ?>%</span>   </a>
                </div>

            </nav>
        <h4 class="small font-weight-bold"></h4>
        <div class="progress  mb-4">
            <div class="progress-bar bg-danger" aria-valuenow="200" aria-valuemin="0" aria-valuemax="100" style="width: <?=$task->Progress?>%;"><span class="sr-only"><?=$task->Progress?>%</span></div>
        </div>
        <?php
        }
        ?>
        <a href="http://taskapi.albertogomp.es/Taskapi.php" class="text-right" target="_blank"> <h6 class="text-primary font-weight-bold m-0" href="">Powered by Taskapi API</h6></a>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-body">
                <div>
                    <div class="form-group"><label for="address"><strong>Nombre</strong></label><input class="form-control" type="text" placeholder="Nombre de la tarea" name="Name" id="Name"></div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group"><label for="city"><strong>Comentario</strong></label><input class="form-control" type="text" placeholder="Información" name="Comments" id="Comments"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="formControlRange"><strong>Progreso</strong></label>
                                <input type="range" class="form-control-range my-auto" id="Progress">

                            </div>
                        </div>
                    </div>
                    <div class="form-group"><button id="enviar" class="btn btn-primary btn-sm">Enviar</button></div>
                    <div id="message"></div>
                </div>
            </div>
        </div>
    </div>
</div>
