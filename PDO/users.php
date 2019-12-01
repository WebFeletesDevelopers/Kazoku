<?php

class users
{
    private $Confirmado;
    private $Rango;
    private $CodUsu;
    private $username;
    private $name;
    private $Telefono;
    private $Apellido1;
    private $Apellido2;
    private $password;
    private $Email;
    private $EmailConfirmado;


    public function user(){

    }
    /**
     * Usuario constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCodusu()
    {
        return $this->Codusu;
    }

    /**
     * @param mixed $Codusu
     */
    public function setCodusu($Codusu): void
    {
        $this->Codusu = $Codusu;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $Telefono
     */
    public function setTelefono($Telefono): void
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return mixed
     */
    public function getApellido1()
    {
        return $this->Apellido1;
    }

    /**
     * @param mixed $Apellido1
     */
    public function setApellido1($Apellido1): void
    {
        $this->Apellido1 = $Apellido1;
    }

    /**
     * @return mixed
     */
    public function getApellido2()
    {
        return $this->Apellido2;
    }

    /**
     * @param mixed $Apellido2
     */
    public function setApellido2($Apellido2): void
    {
        $this->Apellido2 = $Apellido2;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
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
    public function getEmailConfirmado()
    {
        return $this->EmailConfirmado;
    }

    /**
     * @param mixed $EmailConfirmado
     */
    public function setEmailConfirmado ($EmailConfirmado): void
    {
        $this->EmailConfirmado = $EmailConfirmado;
    }
    public function toString(){
        return $this->getName().$this->getApellido1().$this->getApellido2();
    }

}
