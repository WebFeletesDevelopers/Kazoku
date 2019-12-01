<?php

class cinturon {
    private $CodCinturon;
    private $Cinturon;

    /**
     * cinturon constructor.
     */
    public function __construct()
    {
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
    public function setCodCinturon($CodCinturon)
    {
        $this->CodCinturon = $CodCinturon;
    }

    /**
     * @return mixed
     */
    public function getCinturon()
    {
        return $this->Cinturon;
    }

    /**
     * @param mixed $Cinturon
     */
    public function setCinturon($Cinturon)
    {
        $this->Cinturon = $Cinturon;
    }

    public function toString(){
        return $this->CodCinturon.",".$this->Cinturon;
    }


}