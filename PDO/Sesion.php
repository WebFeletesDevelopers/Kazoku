<?php



class Sesion
{
    private $Alta;
    private $Logueado;
    private $Nombre;
    private $CodUsu;
    private $username;
    private $Email;
    private $Rango;
    private $Confirmado;
    private $EmailConfirmado;

    /**
     * Sesion constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }


    /**
     * @return mixed
     */
    public function getAlta()
    {
        return $this->Alta;
    }

    /**
     * @param mixed $Alta
     */
    public function setAlta($Alta): void
    {
        $this->Alta = $Alta;
    }



    /**
     * @return mixed
     */
    public function getLogueado()
    {
        return $this->Logueado;
    }

    /**
     * @param mixed $Logueado
     */
    public function setLogueado($Logueado): void
    {
        $this->Logueado = $Logueado;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre): void
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed
     */
    public function getCodUsu()
    {
        return $this->CodUsu;
    }

    /**
     * @param mixed $CodUsu
     */
    public function setCodUsu($CodUsu): void
    {
        $this->CodUsu = $CodUsu;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getRango()
    {
        return $this->Rango;
    }

    /**
     * @param mixed $Rango
     */
    public function setRango($Rango): void
    {
        $this->Rango = $Rango;
    }

    /**
     * @return mixed
     */
    public function getConfirmado()
    {
        return $this->Confirmado;
    }

    /**
     * @param mixed $Confirmado
     */
    public function setConfirmado($Confirmado): void
    {
        $this->Confirmado = $Confirmado;
    }

    /**
     * @return mixed
     */
    public function getEmailConfirmado()
    {
        return $this->EmailConfirmado;
    }

    /**
     * @param mixed $EmailConfirmado
     */
    public function setEmailConfirmado($EmailConfirmado): void
    {
        $this->EmailConfirmado = $EmailConfirmado;
    }


}








