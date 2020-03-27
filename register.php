<?php
session_start();
if(isset($_SESSION['name'])){
    header('Location: ../../../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>

</head>


<body class="bg-gradient-light">
    <div class="container py-3">
        <div class="card shadow-lg o-hidden border-0 ">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                            <div href="index.php" class="flex-grow-1 bg-register-image"  style="background-image: url(&quot;site/images/logo/logoL.png&quot;); padding: 10%; background-size: contain; background-repeat: no-repeat " ></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Crear cuenta!</h4>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text"   placeholder="Nombre" id="txt_name" name="txt_name" required></div>
                                    <div class="col-sm-4"><input class="form-control form-control-user" type="text" id="txt_lastname1" name="txt_lastname1"  placeholder="Primer Apellido"    required></div>
                                    <div class="col-sm-4"><input class="form-control form-control-user" type="text" id="txt_lastname2" name="txt_lastname2" placeholder="Segundo Apellido"    ></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-7 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text"  placeholder="Nombre de Usuario" id="txt_uname" name="txt_uname"    required></div>
                                    <div class="col-sm-5"><input class="form-control form-control-user" type="text" id="txt_phone" name="txt_phone" placeholder="Teléfono"  ></div>
                                </div>
                                <div class="form-group"><input class="form-control form-control-user" type="email" id="txt_email" name="txt_email" aria-describedby="emailHelp" placeholder="Email"  "  required></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="txt_pwd" name="txt_pwd" placeholder="Password"     required></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password"  id="txt_pwd2" name="txt_pwd2" placeholder="Repeat Password"     required></div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Soy...</label>
                                    <select   id="txt_rango" name="txt_rango" class="form-control"  id="exampleFormControlSelect1">
                                        <option value="3"  class="form-control form-control-user" selected>Alumno</option>
                                        <option value="2" class="form-control form-control-user">Padre</option>
                                        <option value="1"  class="form-control form-control-user">Profesor</option>

                                    </select>
                                </div>
                                <p class="text-center mx-2 text-danger" style="color: red">Recibirás un correo electrónico para verificarlo. Una vez se verifique tendrás que esperar a que confirmemos tu identidad.<br> Esta versión del programa está todavía en desarrollo, se pueden presentar fallos.</p>
                                <div id="message"></div>
                                <button name="but_submit2" id="but_submit2"  class="btn btn-primary btn-block text-white btn-user" type="submit">Registrar</button>

<!--                                <hr><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i class="fab fa-google"></i>&nbsp; Register with Google</a><a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Register with Facebook</a>
-->                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="login.php">¿Ya tienes cuenta? ¡Inicia sesión!</a></div>
                            <div class="text-center"><a class="small" href="index.php">Volver al inicio</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'componentes/commonscripts.php'; ?>

    <script>
        $(document).ready(function(){

            $("#but_submit2").click(function(){
                var name = $("#txt_name").val().trim();
                var lastname1 = $("#txt_lastname1").val().trim();
                var lastname2 = $("#txt_lastname2").val().trim();
                var email = $("#txt_email").val().trim();
                var phone = $("#txt_phone").val().trim();
                var username = $("#txt_uname").val().trim();
                var password1 = $("#txt_pwd").val().trim();
                var password2 = $("#txt_pwd2").val().trim();
                var rango = $("#txt_rango").val().trim();
                if( username !== "" && password1 !== "" && password2 !== ""  && name !=="" && lastname1 !=="" && rango!==""){
                    if(lastname2 === ""){
                        lastname2 = null;
                    }
                    if(email ===""){
                        email = null;
                    }
                    $.ajax({
                        url:'site/controller/RegistroController.php',
                        type:'post',
                        method:'post',
                        data:{username:username,password1:password1,password2:password2,name:name,lastname1:lastname1,lastname2:lastname2,phone:phone,email:email,rango:rango},
                        success:function(response){
                            if(response == 1){
                                window.location = "login.php";

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