<?php


class todo
{
    private $TaskCode;
    private $Name;
    private $Progress;
    private $Comments;
    private $DeathLine;
    private $color;
    private $colorRange = array('000000', '002109', '00330e', '005216', '00731f', '009126', '006e1d', '00b52f', '02db3b');




    public function __construct()
    {}

    /**
     * @return mixed
     */
    public function getTaskCode()
    {
        return $this->TaskCode;
    }

    /**
     * @param mixed $TaskCode
     */
    public function setTaskCode($TaskCode): void
    {
        $this->TaskCode = $TaskCode;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getProgress()
    {
        return $this->Progress;
    }

    /**
     * @param mixed $Progress
     */
    public function setProgress($Progress): void
    {
        $this->Progress = $Progress;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->Comments;
    }

    /**
     * @param mixed $Comments
     */
    public function setComments($Comments): void
    {
        $this->Comments = $Comments;
    }

    /**
     * @return mixed
     */
    public function getDeathLine()
    {
        return $this->DeathLine;
    }

    /**
     * @param mixed $DeathLine
     */
    public function setDeathLine($DeathLine): void
    {
        $this->DeathLine = $DeathLine;
    }
    public function getColorRange()
    {
        return $this->colorRange;
    }
    public function getColor($percentage)
    {
        $value = (int)($percentage/10);
        $rango = $this->getColorRange();
        $this->color = $rango[$value];
        return $this->color;
    }


}