<?php

session_start();

$uname = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$password2 = mysqli_real_escape_string($con,$_POST['password2']);
$name = mysqli_real_escape_string($con,$_POST['name']);
$Apellido1 = mysqli_real_escape_string($con,$_POST['lastname1']);
$Apellido2 = mysqli_real_escape_string($con,$_POST['lastname2']);
$Telefono = mysqli_real_escape_string($con,$_POST['phone']);
$Email = mysqli_real_escape_string($con,$_POST['email']);
$rango =  mysqli_real_escape_string($con,$_POST['rango']);

include_once 'database.php';
include_once 'Sesion.php';
$sesion =  unserialize($_SESSION['Sesion'],Sesion);

if ($uname != "" && $password != "" && ($password2 == $password)){

    $sql_query = "SELECT count(*) as cntUser FROM users WHERE username='$uname'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);
    $count = $row['cntUser'];



    if($count >0){
        echo 0;
    }else{
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql_query = "INSERT INTO `users` (`username`, `name`, `password`,`Apellido1`,`Apellido2`,`Telefono`,`Email`,`rango`) VALUES ('$uname', '$name', '$hash','$Apellido1','$Apellido2','$Telefono','$Email','$rango');";
        $result = mysqli_query($con,$sql_query);

        if($result){
            $sesion->
            $_SESSION['uname'] = $uname;
            $VerCod = md5(mt_rand());
            $sql_query = "INSERT INTO `Verification` (`Code`,`Uname`) VALUES ('$VerCod','$uname'); ";
            $result = mysqli_query($con,$sql_query);
            // ---------------------------------------------------------------------------

            $email_to = $Email;
            $email_subject = 'Confirmación de Alta Club Kazoku';
            $email_from = 'noreply@clubkazoku.es';
            $email_message = "AJIME!\nEstás un paso más cerca de acceder a todo el servicio web del Club Kazoku, ahora es turno de verificar tu correo: \n";
            $email_message .= 'Haz click en este enlace para continuar: nukazoku.albertogomp.es/verificate.php?Code=' .$VerCod.$uname;



            $headers = 'De: noreply@clubkazoku.es'."\r\n".
                'Responder a: desarrollo@clubkazoku.es'."\r\n";
            @mail($email_to, $email_subject, $email_message, $headers);

            // ---------------------------------------------------------------------------



            echo 1;
        }
        else{
            echo 0;
        }

    }

}
else{
    echo 0;
}