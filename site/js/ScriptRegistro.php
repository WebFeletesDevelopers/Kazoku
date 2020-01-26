<script>
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
            var rango = $("#txt_rango").val().trim();
            if( username !== "" && password !== "" && password2 !== ""  && name !=="" && lastname1 !=="" && rango!==""){
                if(lastname2 === ""){
                    lastname2 = null;
                }
                if(email ===""){
                    email = null;
                }
                $.ajax({
                    url:'form/registroB.php',
                    type:'post',
                    method:'post',
                    data:{username:username,password:password,password2:password2,name:name,lastname1:lastname1,lastname2:lastname2,phone:phone,email:email,rango:rango},
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