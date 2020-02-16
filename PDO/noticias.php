<?php

class noticias{
    private $CodNot;
    private $Titulo;
    private $Cuerpo;
    private $Fecha;
    private $CodAutor;
    private $Publlica;

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
     * @param mixed $Fefcha
     */
    public function setFefcha($Fefcha)
    {
        $this->Fefcha = $Fefcha;
    }

    /**
     * @return mixed
     */
    public function getCodAutor()
    {
        return $this->CodAutor;
    }

    /**
     * @param mixed $CodAutor
     */
    public function setCodAutor($CodAutor)
    {
        $this->CodAutor = $CodAutor;
    }

    /**
     * @return mixed
     */
    public function getPubllica()
    {
        return $this->Publlica;
    }

    /**
     * @param mixed $Publlica
     */
    public function setPubllica($Publlica)
    {
        $this->Publlica = $Publlica;
    }

    /*
     * Método to String
     */
    public function toString(){
        return $this->getCodNot()." - ".$this->getTitulo()." - ".$this->getCodAutor()." - ".$this->getCuerpo()." - ".$this->getFecha()." - ".$this->getPubllica();
    }


}