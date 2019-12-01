<?php
class verification{
    private $Code;
    private $CodKey;
    private $Uname;
    private $confirmado;

    /**
     * verification constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @param mixed $Code
     */
    public function setCode($Code)
    {
        $this->Code = $Code;
    }

    /**
     * @return mixed
     */
    public function getCodKey()
    {
        return $this->CodKey;
    }

    /**
     * @param mixed $CodKey
     */
    public function setCodKey($CodKey)
    {
        $this->CodKey = $CodKey;
    }

    /**
     * @return mixed
     */
    public function getUname()
    {
        return $this->Uname;
    }

    /**
     * @param mixed $Uname
     */
    public function setUname($Uname)
    {
        $this->Uname = $Uname;
    }

    /**
     * @return mixed
     */
    public function getConfirmado()
    {
        return $this->confirmado;
    }

    /**
     * @param mixed $confirmado
     */
    public function setConfirmado($confirmado)
    {
        $this->confirmado = $confirmado;
    }




}