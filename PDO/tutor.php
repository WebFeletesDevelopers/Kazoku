<?php

class tutor{
    private $CodTut;
    private $Nombre;
    private $Apellido1;
    private $Apellido2;
    private $Telefono;
    private $DNI;
    private $CodDireccion;
    private $Correo;

    /**
     * tutor constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCodTut()
    {
        return $this->CodTut;
    }

    /**
     * @param mixed $CodTut
     */
    public function setCodTut($CodTut)
    {
        $this->CodTut = $CodTut;
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
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
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
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * @param mixed $DNI
     */
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }

    /**
     * @return mixed
     */
    public function getCodDireccion()
    {
        return $this->CodDireccion;
    }

    /**
     * @param mixed $CodDireccion
     */
    public function setCodDireccion($CodDireccion)
    {
        $this->CodDireccion = $CodDireccion;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @param mixed $Correo
     */
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
    }




}