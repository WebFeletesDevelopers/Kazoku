<?php

class alumno
{
  private  $Nombre;
  private $Apellido1;
  private $Apellido2;
  private $Sexo;
  private $CodAlumno;
  private $CodUsu;
  private $IdFanjyda;
  private $DNI;
  private $FechaNacimiento;
  private $Telefono;
  private $Email;
  private $Enfermedad;
  private $CodTut;
  private $CodCinturon;
  private $CodDireccion;
  private $CodClase;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
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
    public function getSexo()
    {
        return $this->Sexo;
    }

    /**
     * @param mixed $Sexo
     */
    public function setSexo($Sexo): void
    {
        $this->Sexo = $Sexo;
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
    public function setCodAlumno($CodAlumno): void
    {
        $this->CodAlumno = $CodAlumno;
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
    public function getIdFanjyda()
    {
        return $this->IdFanjyda;
    }

    /**
     * @param mixed $IdFanjyda
     */
    public function setIdFanjyda($IdFanjyda): void
    {
        $this->IdFanjyda = $IdFanjyda;
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
    public function setDNI($DNI): void
    {
        $this->DNI = $DNI;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }

    /**
     * @param mixed $FechaNacimiento
     */
    public function setFechaNacimiento($FechaNacimiento): void
    {
        $this->FechaNacimiento = $FechaNacimiento;
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
    public function getEnfermedad()
    {
        return $this->Enfermedad;
    }

    /**
     * @param mixed $Enfermedad
     */
    public function setEnfermedad($Enfermedad): void
    {
        $this->Enfermedad = $Enfermedad;
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
    public function setCodTut($CodTut): void
    {
        $this->CodTut = $CodTut;
    }

    /**
     * @return mixed
     */
    public function getCodCinturon()
    {
        return $this->CodCinturon;
    }

    /**
     * @param mixed $CodCinturon
     */
    public function setCodCinturon($CodCinturon): void
    {
        $this->CodCinturon = $CodCinturon;
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
    public function setCodDireccion($CodDireccion): void
    {
        $this->CodDireccion = $CodDireccion;
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
    public function setCodClase($CodClase): void
    {
        $this->CodClase = $CodClase;
    }




}
