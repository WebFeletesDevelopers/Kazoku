<?php


class centro
{
  private $CodCentro;
  private $Nombre;
  private $Direccion;
  private $CodPostal;
  private $Telefono ;

    /**
     * user constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCodCentro()
    {
        return $this->CodCentro;
    }

    /**
     * @param mixed $CodCentro
     */
    public function setCodCentro($CodCentro)
    {
        $this->CodCentro = $CodCentro;
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

    /**
     * @return mixed
     */
    public function getCodPostal()
    {
        return $this->CodPostal;
    }

    /**
     * @param mixed $CodPostal
     */
    public function setCodPostal($CodPostal)
    {
        $this->CodPostal = $CodPostal;
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




}
