<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-firestore.js"></script>
<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyD5x963mHQZXguDyk3sB2KWVt7VmgKnY0A",
        authDomain: "kazoku-1bd45.firebaseapp.com",
        databaseURL: "https://kazoku-1bd45.firebaseio.com",
        projectId: "kazoku-1bd45",
        storageBucket: "kazoku-1bd45.appspot.com",
        messagingSenderId: "697818195362",
        appId: "1:697818195362:web:31f854d14421fe0c757efb"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    function hacerLogin() {
        console.log("dio click wei");
        var email = document.getElementById('form-login-name-1').value;
        var pass = document.getElementById('form-login-password-1').value;
        firebase.auth().signInWithEmailAndPassword(email, pass).catch(function (error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // ...
            /**
             * En el caso que falle la autenticación de firebase, trata de hacer la autenticación por AJAX a la BD local.
             */
            $.ajax({
                //TODO Cambiar en la lógica la recepción, de username a email o al Firebase token
                url: '<?=$Rutas->LogicaLogin?>',
                type: 'post',
                data: {username: email, password: pass},
                success: function (response) {
                    if (response == 0) {
                        var msg = "Usuario o contraseña no válidos";
                    } else if (response == 1) {
                        window.location = "<?=$Rutas->Index?>";
                    }
                    $("#message").html(msg);
                }

            });
        });
    };
    $(document).keypress(function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
            var username = $("#form-login-name-1").val().trim();
            var password = $("#form-login-password-1").val().trim();
            if (username != "" && password != "") {
                $.ajax({
                    url: '<?=$Rutas->LogicaLogin?>',
                    type: 'post',
                    data: {username: username, password: password},
                    success: function (response) {
                        if (response == 0) {
                            var msg = "Usuario o contraseña no válidos";
                        } else if (response == 1) {
                            window.location = "<?=$Rutas->Index?>";
                        }
                        $("#message").html(msg);
                    }

                });
            }
        }
    });

    $(document).ready(function () {
        $("#but_submit").click(function () {
            var username = $("#form-login-name-1").val().trim();
            var password = $("#form-login-password-1").val().trim();
            if (username != "" && password != "") {
                $.ajax({
                    url: '<?=$Rutas->logicaLogin?>',
                    type: 'post',
                    data: {username: username, password: password},
                    success: function (response) {
                        if (response == 0) {

                            var msg = "Usuario o contraseña no válidos";
                        } else if (response == 1) {
                            window.location = "<?=$Rutas->Index?>";
                        }
                        $("#message").html(msg);
                    }

                });
            }
        });

    });
</script>


