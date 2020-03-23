<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location: ../../../login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'componentes/nav.php'; ?>

    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php include 'componentes/navbar.php'; ?>
            <?php include 'componentes/alta/form.php'; ?>


        </div>
        <?php include 'componentes/footer.php'; ?>
        <?php include 'componentes/commonscripts.php'; ?>
        <script>
            $(document).ready(function(){

                $("#but_submit2").click(function(){
                    var name = $("#Nombre").val().trim();
                    var lastname1 = $("#Apellido1").val().trim();
                    var lastname2 = $("#Apellido2").val().trim();
                    var email = $("#Email").val().trim();
                    var phone = $("#Telefono").val().trim();
                    var username = $("#Uname").val().trim();
                    var password = $("#Password").val().trim();
                    var password2 = $("#Password2").val().trim();
                    var rango = $("#Rango").val().trim();
                    var direccion = $("#Direccion").val().trim();
                    var localidad = $("#Localidad").val().trim();
                    var provinicia = $("#Provincia").val().trim();
                    if( username !== "" && password !== "" && password2 !== ""  && name !=="" && lastname1 !=="" && ){
                        if(lastname2 === ""){
                            lastname2 = null;
                        }
                        if(email ===""){
                            email = null;
                        }
                        $.ajax({
                            url:'./PDO/alta.php',
                            type:'post',
                            method:'post',
                            data:{username:username,password:password,password2:password2,name:name,lastname1:lastname1,lastname2:lastname2,phone:phone,email:email,
                            direccion:direccion,localidad:localidad,provinicia:provinicia},
                            success:function(response){
                                if(response == 1){
                                    window.location = "index.php";

                                }
                                if (response ==0){
                                    //$("#message").load(location.href + " #message");
                                    $("#message").html('<div id="message" class="alert alert-danger text-center" role="alert">Algo fue mal...</div>');

                                }

                            }
                        });
                    }
                    else{
                        $("#message").html('<div id="message" class="alert alert-danger text-center" role="alert">Algo fue mal...</div>');

                    }


                });

            });
        </script>
</body>

</html>