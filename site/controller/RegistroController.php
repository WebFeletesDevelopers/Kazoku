<?php

session_start();
include_once '../../PDO/users.php';
include_once '../../PDO/verification.php';
$user = new users();
/*
$_POST['username']="username1";
$_POST['name']="name";
$_POST['lastname1']="lastname";
$_POST['password1']="pass";
$_POST['password2']="pass";
$_POST['lastname2']="lastname2";
$_POST['phone']=987654322;
$_POST['email']="test1@test.com";
$_POST['rango']=2;
*/
$user->setUsername($_POST['username']);
$user->setConfirmado(0);
$user->setEmailConfirmado(0);
$user->setName($_POST['name']);
$user->setApellido1($_POST['lastname1']);
$user->setApellido2($_POST['lastname2']);
$user->setTelefono($_POST['phone']);
$user->setEmail($_POST['email']);
$user->setCodUsu(0);
if($_POST['rango']>1 && $_POST['rango']<4){
    $user->setRango($_POST['rango']);
}
if ($user->getName() != "" && ($_POST['password1'] === $_POST['password2'])  && $user->getEmail() !="" && $user->getUsername() !=""){
    include '../../PDO/database.php';
    if(!isset($bd)) {
        $bd =  crear();
    }
    $sentencia = $bd->prepare('SELECT * FROM users WHERE username ='.$user->getUsername().';');
    $count = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if(count($count) >0){
        echo 0;
    }else{
        $hash = password_hash($_POST['password1'], PASSWORD_DEFAULT);
        $user->setPassword($hash);
        $insertado = insertar($user,$bd);
        if($insertado){
            echo 1;
            $_SESSION['uname'] = $user->getUsername();
            $Verificar = new verification();
            $Verificar->setCode(md5(mt_rand()));
            $Verificar->setUname($user->getUsername());
            $Verificar->setConfirmado(0);
            // ---------------------------------------------------------------------------

            $email_to = $Verificar->getUname();
            $email_subject = 'Confirmación de Alta Club Kazoku';
            $email_from = 'noreply@clubkazoku.es';
            $email_message = "AJIME!\nEstás un paso más cerca de acceder a todo el servicio web del Club Kazoku, ahora es turno de verificar tu correo: \n";
            $email_message .= 'Haz click en este enlace para continuar: nukazoku.albertogomp.es/verificate.php?Code=' .$Verificar->getCode().$Verificar->getUname();
            $headers = 'De: noreply@clubkazoku.es'."\r\n".
                'Responder a: desarrollo@clubkazoku.es'."\r\n";
            @mail($email_to, $email_subject, $email_message, $headers);
            // ---------------------------------------------------------------------------
            header('Location: ../../../login.php');
        }
        else{
            echo 0;
        }
    }
}
else{
    echo 0;
}