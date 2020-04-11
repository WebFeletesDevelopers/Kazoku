<?php

class noticias{
    public $CodNot;
    public $Titulo;
    public $Cuerpo;
    public $Fecha;
    public $Autor;
    public $Publica;

    /**
     * noticias constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCodNot()
    {
        return $this->CodNot;
    }

    /**
     * @param mixed $CodNot
     */
    public function setCodNot($CodNot)
    {
        $this->CodNot = $CodNot;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->Titulo;
    }

    /**
     * @param mixed $Titulo
     */
    public function setTitulo($Titulo)
    {
        $this->Titulo = $Titulo;
    }

    /**
     * @return mixed
     */
    public function getCuerpo()
    {
        return $this->Cuerpo;
    }

    /**
     * @param mixed $Cuerpo
     */
    public function setCuerpo($Cuerpo)
    {
        $this->Cuerpo = $Cuerpo;
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

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->Autor;
    }

    /**
     * @param mixed $Autor
     */
    public function setAutor($Autor)
    {
        $this->Autor = $Autor;
    }

    /**
     * @return mixed
     */
    public function getPublica()
    {
        return $this->Publica;
    }

    /**
     * @param mixed $Publica
     */
    public function setPublica($Publica)
    {
        $this->Publica = $Publica;
    }

    /*
     * Método to String
     */
    public function toString(){
        return $this->getCodNot()." - ".$this->getTitulo()." - ".$this->getCodAutor()." - ".$this->getCuerpo()." - ".$this->getFecha()." - ".$this->getPublica();
    }


}