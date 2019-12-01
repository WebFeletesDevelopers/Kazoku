<?php


class clase{
    private $CodClase;
    private $Horario;
    private $Profesor;
    private $EdadMin;
    private $EdadMax;
    private $Nombre;
    private $CodCentro;
    private $Dias;

    /**
     * clase constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCodClase()
    {
        return $this->CodClase;
    }

    /**
     * @param mixed $CodClase
     */
    public function setCodClase($CodClase)
    {
        $this->CodClase = $CodClase;
    }

    /**
     * @return mixed
     */
    public function getHorario()
    {
        return $this->Horario;
    }

    /**
     * @param mixed $Horario
     */
    public function setHorario($Horario)
    {
        $this->Horario = $Horario;
    }

    /**
     * @return mixed
     */
    public function getProfesor()
    {
        return $this->Profesor;
    }

    /**
     * @param mixed $Profesor
     */
    public function setProfesor($Profesor)
    {
        $this->Profesor = $Profesor;
    }

    /**
     * @return mixed
     */
    public function getEdadMin()
    {
        return $this->EdadMin;
    }

    /**
     * @param mixed $EdadMin
     */
    public function setEdadMin($EdadMin)
    {
        $this->EdadMin = $EdadMin;
    }

    /**
     * @return mixed
     */
    public function getEdadMax()
    {
        return $this->EdadMax;
    }

    /**
     * @param mixed $EdadMax
     */
    public function setEdadMax($EdadMax)
    {
        $this->EdadMax = $EdadMax;
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
    public function getDias()
    {
        return $this->Dias;
    }

    /**
     * @param mixed $Dias
     */
    public function setDias($Dias)
    {
        $this->Dias = $Dias;
    }




}
