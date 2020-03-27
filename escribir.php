<?php
session_start();
include 'site/controller/SessionController.php';
if(isAdmin() || isProfe()){

}else{
    header('Location: ../../../register.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nueva noticia - Kazoku</title>
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
                <div class="form-signin">
                    <div class="text-center mb-4">
                        <img class="mb-4" src="assets/img/Logo/logo-judo-93x94.png" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Escribir nueva noticia</h1>
                    </div>

                    <div class="form-label-group">
                        <label for="inputPassword">Titulo de la noticia</label>
                        <textarea class="form-control" type="text" name="titulo" id="titulo" rows="1" required></textarea>
                        <div class="text-right"><span id="caracterest" class="valid-text pt-3" id="caracterest"></span></div>


                    </div>

                    <div class="form-label-group">
                        <label for="inputPassword">Cuerpo de la noticia</label>
                        <textarea class="form-control" type="text" name="mensaje" id="mensaje" rows="6" required></textarea>
                        <div class="text-right"><span id="caracteres" class="valid-text pt-3" id="caracteres"></span></div>

                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <select class="form-control form-control-md" id="publica">
                                <option selected value="0">Privada</option>
                                <option value="1">Pública</option>
                            </select>
                        </label>
                    </div>
                    <div id="message"></div>
                    <button class="btn btn-lg btn-primary btn-block" id="enviar">Publicar</button>
                </div>
                <!-- End: Chart -->
            </div>
        </div>

        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
        <script>
            $("#mensaje").on('keypress', function() {
                var limite = 5000;
                $("#mensaje").attr('maxlength', limite);
                var caracteres = $(this).val().length;

                if(caracteres<limite){
                    caracteres++;
                    if(caracteres >= 255){
                        $('#caracteres').text(caracteres+"/"+limite+" caracteres" );
                    }

                }

            });
            $("#titulo").on('keypress', function() {
                var limite = 255;
                $("#titulo").attr('maxlength', limite);
                var caracteres = $(this).val().length;

                if(caracteres<limite){
                    caracteres++;
                    if(caracteres >= 100){
                        $('#caracterest').text(caracteres+"/"+limite+" caracteres" );
                    }

                }

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#enviar").click(function(){
                    var Titulo = $("#titulo").val().trim();
                    var Cuerpo = $("#mensaje").val().trim();
                    var Publico = $("#publica").val().trim();
                    var Autor = "<?=$_SESSION['uname'];?>";
                    if( Cuerpo != "" && Titulo != "" && (Publico==1 || Publico == 0) && Autor!="" ){
                        $.ajax({
                            url:'./site/negocio/negocioNoticias.php',
                            type:'post',
                            data:{Accion:2,Titulo:Titulo,Cuerpo:Cuerpo,Publico:Publico,Autor:Autor},
                            success:function(response){
                                if(response == 0){
                                    var msg = "Error en el envío, revise los datos";
                                    $("#message").html('<h1 class="alert alert-danger">'+msg+'</h1>');
                                }else if(response == 1){
                                     window.location = "index.php";
                                }
                            },
                            error:function(response){
                                $("#message").html('<h1 class="alert alert-primary">Hubo un error desconocido</h1>');
                                //window.location = "../index.php";
                            }

                        });
                    }
                });

            });
        </script>
</body>

</html>