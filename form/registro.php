<?php

session_start();
include_once '../PDO/users.php';
$user = new users();
/* $_POST['username']="test";
$_POST['name']="test";
$_POST['lastname1']="test";
$_POST['password1']="test";
$_POST['password2']="test";
$_POST['lastname2']="test";
$_POST['phone']=987654321;
$_POST['email']="test@test.com";
$_POST['rango']=2; */
$user->setUsername($_POST['username']);
$user->setName($_POST['username']);
$user->setApellido1($_POST['lastname1']);
$user->setApellido2($_POST['lastname2']);
$user->setTelefono($_POST['phone']);
$user->setEmail($_POST['email']);
if($_POST['rango']>1 && $_POST['rango']<4){
    $user->setRango($_POST['rango']);
}
if ($user->getName() != "" && ($_POST['password1'] === $_POST['password2'])  && $user->getEmail() !="" && $user->getUsername() !=""){
    include '../PDO/database.php';
    if(!isset($bd)) {
       $bd =  crear();
    }
    $sentencia = $bd->prepare('SELECT * FROM users WHERE username ='.$user->getUsername().';');
    $count = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if(count($count) >0){
        echo 0;
    }else{
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->setPassword($hash);
        $insertado = insertar($user,$bd);
        echo " ";
        echo var_dump($insertado);
        //$sql_query = "INSERT INTO `users` (`username`, `name`, `password`,`Apellido1`,`Apellido2`,`Telefono`,`Email`,`rango`) VALUES ('$uname', '$name', '$hash','$Apellido1','$Apellido2','$Telefono','$Email','$rango');";
        //$result = mysqli_query($con,$sql_query);
        if($insertado){
            $_SESSION['uname'] = $user->getUsername();
            $VerCod = md5(mt_rand());
            $uname = $user->getUsername();
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
    echo 1;
}