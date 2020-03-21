<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'componentes/nav.php'; ?>
        <?php
        $sesion = unserialize($_SESSION['sesion'],Sesion);
        echo $sesion->name;
        ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <div class="container-fluid">
                <?php include 'componentes/index/carousel.php'; ?>
                <?php include 'componentes/index/noticias.php'; ?>
                <!-- Start: Chart -->

            <!-- End: Chart -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <?php include 'componentes/index/porcentajes.php'; ?>

                </div>

            </div>
        </div>
    </div>
    <?php include 'componentes/footer.php'; ?>
    <?php include 'componentes/commonscripts.php'; ?>
    <?php include 'template/chat.php'; ?>
            <script>
                $(document).ready(function(){
                    $("#enviar").click(function(){
                        var Name = $("#Name").val().trim();
                        var Comments = $("#Comments").val().trim();
                        var Progress = $("#Progress").val().trim();
                        if( Name!=""){
                            $.ajax({
                                url:'api/Taskapi.php',
                                type:'GET',
                                method:'GET',
                                data:{accion:1,Name:Name,Comments:Comments,Progress:Progress},
                                success:function(response){
                                    location.reload();
                                }
                            });
                        }
                        else{
                            $("#message").html('<div id="message" class="alert alert-danger text-center" role="alert">Algo fue mal...</div>');

                        }
                    });
                $('.borrar').click(function(e){
                    var TaskCode = $(this).data("code");
                    e.preventDefault();
                    $.ajax({
                        url:'http://nukazoku.albertogomp.es/api/Taskapi.php',
                        type:'get',
                        data:{accion:2,TaskCode:TaskCode},
                        success:function(){
                            location.reload();
                        }
                    });
                });
                    $('.actualizar').click(function(e){
                        var TaskCode = $(this).data("code");
                        var Name = $(this).data("name");
                        var Progress = $(this).data("progress");
                        var Comments = $(this).data("comments");

                        var Name = prompt("Nombre:", Name);
                        var Progress = prompt("Progreso (0-100 sin decimales):", Progress);
                        var Comments = prompt("Comentarios:", Comments);


                        //e.preventDefault();
                        $.ajax({
                            url:'http://nukazoku.albertogomp.es/api/Taskapi.php',
                            type:'get',
                            methd:'get',
                            data:{accion:3,TaskCode:TaskCode, Name:Name,Progress:Progress,Comments:Comments},
                            success:function(response){
                                location.reload();
                            },
                            error:function () {
                                location.reload();
                            }
                        });
                    });
                });
            </script>
</body>

</html>
