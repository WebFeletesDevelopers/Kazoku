<!doctype html>
<html>
<head>
    <title>Register</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <script src="jquery-3.2.1.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $("#but_submit").click(function(){
                var name = $("#txt_name").val().trim();
                var username = $("#txt_uname").val().trim();
                var password = $("#txt_pwd").val().trim();
                var password2 = $("#txt_pwd2").val().trim();

                if( username != "" && password != "" && password2 != ""  && name !=""){
                    $.ajax({
                        url:'register.php',
                        type:'post',
                        data:{username:username,password:password,password2:password2,name:name},
                        success:function(response){
                            var msg = "";
                            if(response != 1){
                                window.location = "home.php";
                            }else{
                                msg = "Invalid username and password!";
                            }
                            $("#message").html(msg);
                        }
                    });
                }
            });

        });

    </script>
</head>
<body>
<div class="container">

    <div id="div_login">
        <h1>Register</h1>
        <div id="message"></div>
        <div>
            <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
        </div>
        <div>
            <input type="text" class="textbox" id="txt_name" name="txt_name" placeholder="Name" />
        </div>
        <div>
            <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password"/>
        </div>
        <div>
            <input type="password" class="textbox" id="txt_pwd2" name="txt_pwd2" placeholder="Repeat Password"/>
        </div>
        <div>
            <input type="button" value="Submit" name="but_submit" id="but_submit" />
        </div>
    </div>

</div>
</body>
</html>

