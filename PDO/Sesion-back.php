<?php
require_once("database.php") ;
require_once("users.php");

class Sesion
{
private $usuario ;
private $time_expire = 30000 ;				// segundos
private static $instancia = null ;

/**
*/
private function __construct() { }

/**
*/
private function __clone() { }

/**
*/
public function getUsuario()
{
return $this->usuario ;
}

/**
*/
public function close()
{
// vaciamos las variables de sesi�n
$_SESSION = [] ;

// destruir la sesi�n
session_destroy() ;
}

/**
*/
public static function getInstance()
{
session_start() ;

// comprobamos
if (isset($_SESSION["_sesion"])):
self::$instancia = unserialize($_SESSION["_sesion"] ) ;
else:
if (self::$instancia===null)
self::$instancia = new Sesion() ;
endif ;

// devolvemos la instancia
return self::$instancia ;
}

/**
*/
public function login(string $uname, string $pas):bool
{
// instanciar la clase Database
$db = Database::getInstance("ddb135595","Hola??716","ddb135595") ;
// buscamos el usuario
//$sql  = "SELECT * FROM usuario WHERE email=:ema AND pass=MD5(:pas) ; " ;
$sql = "SELECT * FROM users WHERE username='$uname'" ;

if ($db->query($sql)):

// rescatar la informaci�n del usuario
$this->user = $db->getObject("users") ;
if(passwords.checkPassword($pas,))
// si el usuario es correcto, iniciamos la sesi�n
// guardamos el momento (segs.) en que se inicia
// la sesi�n
$_SESSION["time"]    = time() ;
$_SESSION["_sesion"] = serialize(self::$instancia) ;

// la sesi�n se ha iniciado
return true ;

endif ;

// la sesi�n no se ha iniciado
return false ;
}

/**
* @return bool
*/
public function isExpired():bool
{
return (time() - $_SESSION["time"] > $this->time_expire) ;
}

/**
* @return bool
*/
public function isLogged():bool
{
return !empty($_SESSION) ;
}

/**
* @return bool
*/
public function checkActiveSession():bool
{
if ($this->isLogged())
if (!$this->isExpired()) return true ;
//
return false ;
}

/**
*/
public function redirect(string $url)
{
header("Location: $url") ;
die() ;
}

/**
*/
public function __sleep()
{
return ["user", "instancia"] ;
}

}

?>