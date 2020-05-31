<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Clase
 * Class entity
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Clase
{
    private int $id;
    private string $schedule;
    private string $trainer;
    private int $minimumAge;
    private int $maximumAge;
    private string $name;
    private int $centerId;
    private int $days;

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
     */
    public function __construct(
        int $id,
        string $schedule,
        string $trainer,
        int $minimumAge,
        int $maximumAge,
        string $name,
        int $centerId,
        int $days
    ) {
        $this->id = $id;
        $this->schedule = $schedule;
        $this->trainer = $trainer;
        $this->minimumAge = $minimumAge;
        $this->maximumAge = $maximumAge;
        $this->name = $name;
        $this->centerId = $centerId;
        $this->days = $days;
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
