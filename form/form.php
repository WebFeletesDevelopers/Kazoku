<script type="text/javascript">
    $(document).ready(function(){

        $("#but_submit").click(function(){
            var username = $("#txt_uname1").val().trim();
            var password = $("#txt_pwd1").val().trim();
            if( username != "" && password != "" ){
                $.ajax({
                    url:'./form/checkUser.php',
                    type:'post',
                    data:{username:username,password:password},
                    success:function(response){
                        var msg = "";
                        if(response === 0){

                            msg = "Usuario o contraseña no válidos";
                        }else{
                            window.location = "../index.php";
                        }
                        $("#message").html(msg);
                    }
                });
            }
        });

    });
    $(document).ready(function(){

        $("#but_submit2").click(function(){
            var name = $("#txt_name").val().trim();
            var lastname1 = $("#txt_lastname1").val().trim();
            var lastname2 = $("#txt_lastname2").val().trim();
            var email = $("#txt_email").val().trim();
            var phone = $("#txt_phone").val().trim();
            var username = $("#txt_uname").val().trim();
            var password = $("#txt_pwd").val().trim();
            var password2 = $("#txt_pwd2").val().trim();

            if( username != "" && password != "" && password2 != ""  && name !="" && lastname1 !="" && phone !="" && email!=""){
                if(lastname2 == ""){
                    lastname2 = null;
                }
                $.ajax({
                    url:'./form/register.php',
                    type:'post',
                    data:{username:username,password:password,password2:password2,name:name,lastname1:lastname1,lastname2:lastname2,phone:phone,email:email},
                    success:function(response){
                        var msg = "";
                        if(response != 1){
                            msg = "Registrado con éxito, por favor, inicie sesión";
                            window.location = "../login.php";
                        }else{
                            msg = "Usuario o contraseña erróneos";
                        }
                        $("#message").html(msg);
                    }
                });
            }
        });

    });
</script>
<!------ Include the above in your HEAD tag ---------->
<div class="container-fluid my-5" >
    <div class="row" style="background-color: rgba(0,0,0,0)">
        <div class="col-md-3 col-md-offset-3"></div>
        <div class="col-md-6 col-md-offset-3 p-0 rounded rounded-5 " style="background-color: #FFFFFF">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row m-2">
                        <div class="col-md-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" id="register-form-link">Registro</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body mx-5">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div id="login-form"  style="display: block;">
                                <div id="message"></div>
                                <div class="form-group">
                                    <input type="text" class="form-control text-center " id="txt_uname1" name="txt_uname1" placeholder="Username"  />
                                </div>
                                <div class="form-group">

                                    <input type="password" class="text-center form-control" id="txt_pwd1" name="txt_pwd1" placeholder="Password"/>
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3"  id="remember_me" name="remember_me" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group text-center">
                                    <div class="row text-center">
                                        <div class="col-sm-12 col-sm-offset-3">
                                            <input type="button" value="Submit" name="but_submit" id="but_submit" class="form-control btn btn-login" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="register-form" action="https://phpoll.com/register/process" method="post" role="form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" class="textbox form-control text-center" id="txt_uname" name="txt_uname" placeholder="Usuario" class="form-control"  required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="textbox form-control text-center" id="txt_email" name="txt_email" placeholder="Email" class="form-control"  required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="textbox form-control text-center" id="txt_name" name="txt_name" placeholder="Nombre" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="textbox form-control text-center" id="txt_lastname1" name="txt_lastname1" placeholder="Primer Apellido" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="textbox form-control text-center" id="txt_lastname2" name="txt_lastname2" placeholder="Segundo Apellido"  />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="textbox form-control text-center" id="txt_phone" name="txt_phone" placeholder="Telefono" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="textbox form-control text-center" id="txt_pwd" name="txt_pwd" placeholder="Contraseña" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="textbox form-control text-center"  id="txt_pwd2" name="txt_pwd2" placeholder="Repetir Contraseña" required/>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-sm-offset-3">
                                            <p class="text-center mx-2 text-danger" style="color: red">Recibirás un correo electrónico para verificar tu correo. Una vez se verifique tendrás que esperar a que confirmemos tu identidad.</p>
                                            <input type="button" value="Enviar" placeholder="" name="but_submit2" id="but_submit2" class="form-control btn btn-primary text-center container-fluid" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>