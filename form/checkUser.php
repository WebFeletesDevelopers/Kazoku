<?php
//include "config.php";
include "../PDO/database.php";
include "../PDO/Sesion.php";


session_start();

//$uname = mysqli_real_escape_string($con,$_POST['username']);
$uname = $_POST['username'];
//$password = mysqli_real_escape_string($con,$_POST['password']);
$password = $_POST['password'];

if ($uname != "" && $password != ""){
    $sql = "SELECT * FROM users WHERE username = '".$uname."'";
    $bd = create();
    $query = $bd->query($sql);
    $usuario = $query->fetchObject();

    //$sql_query = "SELECT * FROM users WHERE username='".$uname."'";
    //$result = mysqli_query($con,$sql_query);
    //$row = mysqli_fetch_array($result);
    //$passwordcheck = password_verify($password, $row['password']);
    $passwordcheck = password_verify($password, $usuario->password);

    if($passwordcheck){
        //session_regenerate_id();
        $sesion = new Sesion();

        if(!is_null($usuario->CodUsu)){
            $_SESSION['Alta'] = TRUE;
            $sesion->setAlta(TRUE);
        }
        else{
            $_SESSION['Alta'] = FALSE;
            $sesion->setAlta(FALSE);
        }

        $_SESSION['loggedin'] = TRUE;
        $sesion->setLogueado(TRUE);
        $_SESSION['uname'] = $uname;
        $_SESSION['name'] = $uname; //TODO: Eliminar esta variable, puede dar lugar a error
        $sesion->setUsername($uname);
        $_SESSION['CodUsu'] = $usuario->CodUsu;
        $sesion->setCodUsu($usuario->CodUsu);
        $_SESSION['Email']=   $usuario->Email;
        $sesion->setEmail($usuario->Email);
        $_SESSION['Rango'] = $usuario->Rango;
        $sesion->setRango($usuario->Rango);
        $_SESSION['Confirmado'] = $usuario->Confirmado;
        $sesion->setConfirmado($usuario->Confirmado);
        $_SESSION['Nombre']=$usuario->name;
        $_SESSION['Apellido1']=$usuario->Apellido1;
        $_SESSION['Apellido2']=$usuario->Apellido2;
        $_SESSION['CodUsu'] = $usuario->CodUsu;
        $_SESSION["ApiKey"] = $usuario->username;

        $sql = "SELECT * FROM Verification WHERE  Uname ='".$usuario->username."'";
        $verify = $bd->query($sql);
        $ApiKey = $verify->fetchObject();
        //$sql1 = 'select * from alumno where CodUsu = ' . $row['CodUsu'];
        //$query = $con->query($sql1);

        if(!isset($bd)){
            $bd = create();
        }
        $sql = 'SELECT * FROM alumno WHERE CodUsu = '.$usuario->CodUsu;
        $sentencia = $bd->query($sql);
        $alumno = $sentencia->fetchObject();
        if(isset($alumno)){
            //$sesion->setNombre($alumno->name);
            //$_SESSION['Nombre']=$alumno->name;

        }
        else{
            $sesion->setNombre($usuario->name);
            $_SESSION['Nombre']=$usuario->name;
            $_SESSION['Apellido1']=$usuario->Apellido1;
            $_SESSION['Apellido2']=$usuario->Apellido2;
        }
        /*if ($query->num_rows > 0) {
            while ($r = $query->fetch_object()) {
                $alumno = $r;
                break;
            }
        }*/
        //$_SESSION['Nombre']=$alumno->Nombre;
        //mysqli_close();
        //$_SESSION['Sesion']= serialize($sesion);
        echo 1;
    }else{
        echo 0;
    }

}
