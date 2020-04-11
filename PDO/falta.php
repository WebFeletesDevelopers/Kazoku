<?php

class falta{
    public $CodFalta;
    public $CodAlumno;
    public $CodClase;
    public $Fecha;

    /**
     * falta constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCodFalta()
    {
        return $this->CodFalta;
    }

    /**
     * @param mixed $CodFalta
     */
    public function setCodFalta($CodFalta)
    {
        $this->CodFalta = $CodFalta;
    }

    /**
     * @return mixed
     */
    public function getCodAlumno()
    {
        return $this->CodAlumno;
    }

    /**
     * @param mixed $CodAlumno
     */
    public function setCodAlumno($CodAlumno)
    {
        $this->CodAlumno = $CodAlumno;
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
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param mixed $Fecha
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }




}