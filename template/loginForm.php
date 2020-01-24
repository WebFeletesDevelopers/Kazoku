

<script type="text/javascript">
    $(document).ready(function(){
        alert("cargado");
        $("#but_submit").click(function(){
            var username = $("#txt_uname").val().trim();
            var password = $("#txt_pwd").val().trim();
            alert("ah");
            if( username != "" && password != "" ){
                $.ajax(
                    url:'./login/checkUser.php',
                    type:'post',
                    data:{username:username,password:password},
                    success:function(response){
                        var msg = "";
                        alert("holis");

                        if(response == 1){
                            window.location = "index.php";
                        }else{
                            msg = "Invalid username and password!";
                        }
                        $("#message").html(msg);
                    }
            );
            }
            }
        });

    });
</script>
<section class="section section-variant-1 bg-gray-100">
    <div class="container">
        <div class="row row-50 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card-login-register" id="card-l-r">
                    <div class="card-top-panel">
                        <div class="card-top-panel-left">
                            <h5 class="card-title card-title-login">Login</h5>
                            <h5 class="card-title card-title-register">Registrar</h5>
                        </div>
                        <div class="card-top-panel-right"><span class="card-subtitle"><span class="card-subtitle-login">Registrate ahora</span><span class="card-subtitle-register">Inicia Sesi?n</span></span>
                            <button class="card-toggle" data-custom-toggle="#card-l-r"><span class="card-toggle-circle"></span></button>
                        </div>
                    </div>
                    <div class="card-form card-form-login">
                        <h1></h1>
                        <div class="rd-form rd-mailform" >
                            <div class="form-wrap">
                                <div id="message">Test</div>
                                    <label class="form-label" for="form-login-name-1" id="txt_uname" name="txt_uname">Usuario</label>
                                <input class="form-input" id="form-login-name-1" type="text" name="username" data-constraints="@Required">
                            </div>
                            <div class="form-wrap">
                                <label class="form-label" for="form-login-password-1" id="txt_pwd" name="txt_pwd">Contrase�a</label>
                                <input class="form-input" id="form-login-password-1" type="password" name="password" data-constraints="@Required">
                            </div>
                            <label class="checkbox-inline checkbox-inline-lg checkbox-light">
                                <input name="input-checkbox-1" value="checkbox-1" type="checkbox">Mantener sesi�n iniciada
                            </label>
                            <input type="button" value="Submit" name="but_submit" id="but_submit" />
<!--<!--                            <button class="button button-lg button-primary button-block" value="Submit" name="but_submit" id="but_submit" type="submit">Iniciar sesi?n</button>
-->-->                        </div>
                        <div class="group-sm group-sm-justify group-middle"><a class="button button-google button-icon button-icon-left button-round" href="#"><span class="icon fa fa-google-plus"></span><span>Google+</span></a><a class="button button-twitter button-icon button-icon-left button-round" href="#"><span class="icon fa fa-twitter"></span><span>Twitter</span></a><a class="button button-facebook button-icon button-icon-left button-round" href="#"><span class="icon fa fa-facebook"></span><span>Facebook</span></a></div>
                    </div>
                    <div class="card-form card-form-register">
                        <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                            <div class="form-wrap">
                                <label class="form-label" for="form-register-email">E-mail</label>
                                <input class="form-input" id="form-register-email" type="email" name="email" data-constraints="@Email @Required">
                            </div>
                            <div class="form-wrap">
                                <label class="form-label" for="form-login-name-2">Usuario</label>
                                <input class="form-input" id="form-login-name-2" type="text" name="form-input" data-constraints="@Required">
                            </div>
                            <div class="form-wrap">
                                <label class="form-label" for="form-login-password-2">Contrase?a</label>
                                <input class="form-input" id="form-login-password-2" type="password" name="password" data-constraints="@Required">
                            </div>
                            <div class="form-wrap">
                                <label class="form-label" for="form-login-password-3">Repetir contrase?a</label>
                                <input class="form-input" id="form-login-password-3" type="password" name="password" data-constraints="@Required">
                            </div>
                            <button class="button button-lg button-primary button-block" type="submit" onclick="">Crear cuenta</button>
                        </form>
                        <div class="group-sm group-sm-justify group-middle"><a class="button button-google button-icon button-icon-left button-round" href="#"><span class="icon fa fa-google-plus"></span><span>Google+</span></a><a class="button button-twitter button-icon button-icon-left button-round" href="#"><span class="icon fa fa-twitter"></span><span>Twitter</span></a><a class="button button-facebook button-icon button-icon-left button-round" href="#"><span class="icon fa fa-facebook"></span><span>Facebook</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
