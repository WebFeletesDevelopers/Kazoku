<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Clase
 * Class entity
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class ClaseExtendida
{
    private int $id;
    private string $schedule;
    private string $trainer;
    private int $minimumAge;
    private int $maximumAge;
    private string $name;
    private int $centerId;
    private int $days;
    private string $centerName;
    private int $centerSt;
    private int $centerTel;
    private int $judokas;

    /**
     * Clase constructor.
     * @param int $id
     * @param string $schedule
     * @param string $trainer
     * @param int $minimumAge
     * @param int $maximumAge
     * @param string $name
     * @param int $centerId
     * @param int $days
     * @param string $centerName
     * @param int $centerSt
     * @param int $centerTel
     * @param int $judokas
     */
    public function __construct(
        int $id,
        string $schedule,
        string $trainer,
        int $minimumAge,
        int $maximumAge,
        string $name,
        int $centerId,
        int $days,
        string $centerName,
        int $centerSt,
        int $centerTel,
        int $judokas

    ) {
        $this->id = $id;
        $this->schedule = $schedule;
        $this->trainer = $trainer;
        $this->minimumAge = $minimumAge;
        $this->maximumAge = $maximumAge;
        $this->name = $name;
        $this->centerId = $centerId;
        $this->days = $days;
        $this->centerName = $centerName;
        $this->centerSt = $centerSt;
        $this->centerTel = $centerTel;
        $this->judokas = $judokas;
    }

    /**
     * @return string
     */
    public function getCenterName(): string
    {
        return $this->centerName;
    }

    /**
     * @param string $centerName
     */
    public function setCenterName(string $centerName): void
    {
        $this->centerName = $centerName;
    }

    /**
     * @return int
     */
    public function getCenterSt(): int
    {
        return $this->centerSt;
    }

    /**
     * @param int $centerSt
     */
    public function setCenterSt(int $centerSt): void
    {
        $this->centerSt = $centerSt;
    }

    /**
     * @return int
     */
    public function getCenterTel(): int
    {
        return $this->centerTel;
    }

    /**
     * @param int $centerTel
     */
    public function setCenterTel(int $centerTel): void
    {
        $this->centerTel = $centerTel;
    }

    /**
     * @return int
     */
    public function getJudokas(): int
    {
        return $this->judokas;
    }

    /**
     * @param int $judokas
     */
    public function setJudokas(int $judokas): void
    {
        $this->judokas = $judokas;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function schedule(): string
    {
        return $this->schedule;
    }

    /**
     * @return string
     */
    public function trainer(): string
    {
        return $this->trainer;
    }

    /**
     * @return int
     */
    public function minimumAge(): int
    {
        return $this->minimumAge;
    }

    /**
     * @return int
     */
    public function maximumAge(): int
    {
        return $this->maximumAge;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function centerId(): int
    {
        return $this->centerId;
    }

    /**
     * @return int
     */
    public function days(): int
    {
        return $this->days;
    }
}
