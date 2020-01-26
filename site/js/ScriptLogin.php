<script>
    $(document).keypress(function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
            var username = $("#form-login-name-1").val().trim();
            var password = $("#form-login-password-1").val().trim();
            if( username != "" && password != "" ){
                $.ajax({
                    url:'site/form/checkUser.php',
                    type:'post',
                    data:{username:username,password:password},
                    success:function(response){
                        if(response == 0){
                            var msg = "Usuario o contraseña no válidos";
                        }else if(response == 1){
                            window.location = "../index.php";
                        }
                        $("#message").html(msg);
                    }

                });
            }            }
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#but_submit").click(function(){
            var username = $("#form-login-name-1").val().trim();
            var password = $("#form-login-password-1").val().trim();
            if( username != "" && password != "" ){
                $.ajax({
                    url:'site/form/checkUser.php',
                    type:'post',
                    data:{username:username,password:password},
                    success:function(response){
                        if(response == 0){
                            var msg = "Usuario o contraseña no válidos";
                        }else if(response == 1){
                            window.location = "../index.php";
                        }
                        $("#message").html(msg);
                    }

                });
            }
        });

    });
</script>