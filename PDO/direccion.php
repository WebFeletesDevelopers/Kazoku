<?php

class direccion{

    private $CodDireccion;
    private $CodigoPostal;
    private $Localidad;
    private $Provincia;
    private $Direccion;

    /**
     * direccion constructor.
     */
    public function __construct()
    {
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
    public function getCodigoPostal()
    {
        return $this->CodigoPostal;
    }

    /**
     * @param mixed $CodigoPostal
     */
    public function setCodigoPostal($CodigoPostal)
    {
        $this->CodigoPostal = $CodigoPostal;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->Localidad;
    }

    /**
     * @param mixed $Localidad
     */
    public function setLocalidad($Localidad)
    {
        $this->Localidad = $Localidad;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->Provincia;
    }

    /**
     * @param mixed $Provincia
     */
    public function setProvincia($Provincia)
    {
        $this->Provincia = $Provincia;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param mixed $Direccion
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }



}