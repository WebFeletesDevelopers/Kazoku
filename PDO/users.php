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



    /**
     * users constructor.
     */
    public function __construct()
    {
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
    public function setConfirmado($Confirmado)
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
    public function setRango($Rango)
    {
        $this->Rango = $Rango;
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
    public function setCodUsu($CodUsu)
    {
        $this->CodUsu = $CodUsu;
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
    public function setUsername($username)
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
    public function setName($name)
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
    public function setTelefono($Telefono)
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
    public function setApellido1($Apellido1)
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
    public function setApellido2($Apellido2)
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
    public function setPassword($password)
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
    public function setEmail($Email)
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
    public function setEmailConfirmado($EmailConfirmado)
    {
        $this->EmailConfirmado = $EmailConfirmado;
    }


}
