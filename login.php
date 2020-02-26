<?php
session_start();
if (isset($_SESSION['name'])) {
    header('Location: ../../../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - Kazoku</title>
    <?php include 'componentes/commonhead.php'; ?>
</head>

<body class="bg-gradient-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image"
                                 style="background-image: url(&quot;site/images/logo/logoL.png&quot;);"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Bienvenido!</h4>
                                </div>
                                <div class="user">
                                    <div class="form-group">
                                        <input class="form-control form-control-user"
                                               id="txt_uname1"
                                               name="txt_uname1"
                                               type="text"
                                               placeholder="Usuario">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user"
                                               id="txt_pwd1"
                                               name="txt_pwd1"
                                               type="password"
                                               id="exampleInputPassword"
                                               placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check">
                                                <input class="form-check-input custom-control-input"
                                                       type="checkbox"
                                                       id="formCheck-1">
                                                <label
                                                        class="form-check-label custom-control-label"
                                                        for="formCheck-1">Recuerdame
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block text-white btn-user"
                                            type="submit"
                                            id="but_submit">Login
                                    </button>
                                    <div class="alert alert-danger d-none text-center my-2" id="message"></div>
                                    <!--                                        <hr><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i class="fab fa-google"></i>&nbsp; Login with Google</a><a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Login with Facebook</a>
                                    -->
                                    <hr>
                                </div>
                                <div class="text-center"><a class="small" href="index.php">Volver al inicio</a></div>
                                <div class="text-center"><a class="small" href="forgot-password.html">¿olvidaste la
                                        contraseña?</a></div>
                                <div class="text-center"><a class="small" href="register.php">Crear cuenta!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'componentes/commonscripts.php'; ?>
<script>
    $(document).keypress(function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
           hacerLogin();
        }
    });
    $(document).ready(hacerLogin());
    function hacerLogin() {
        $("#but_submit").click(function () {
            var username = $("#txt_uname1").val().trim();
            var password = $("#txt_pwd1").val().trim();
            if (username != "" && password != "") {
                $.ajax({
                    url: 'site/controller/LoginController.php',
                    type: 'post',
                    data: {username: username, password: password},
                    success: function (response) {
                        if (response == 0) {
                            var msg = "Usuario o contraseña no válidos";
                            $("#message").html(msg);
                            var div = document.getElementById("message");
                            div.classList.remove("d-none");

                        } else if (response == 1) {
                            window.location = "../index.php";
                        }

                    }

                });
            }else{
                var msg = "Usuario o contraseña incorrecto(s), revise los datos";
                $("#message").html(msg);
                var div = document.getElementById("message");
                div.classList.remove("d-none");
            }
        });

    }
</script>
</body>

</html>