<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

use DateTime;

/**
 * Class Alumno
 * Pupil entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Alumno
{
    private string $name;
    private string $surname;
    private string $secondSurname;
    private int $gender;
    private int $id;
    private int $userId;
    private int $fanjydaId;
    private string $dni;
    private DateTime $birthDate;
    private int $phone;
    private string $email;
    private string $diseases;
    private int $trainerId;
    private int $beltId;
    private int $addressId;
    private int $classId;

    /**
     * Alumno constructor.
     * @param string $name
     * @param string $surname
     * @param string $secondSurname
     * @param int $gender
     * @param int $id
     * @param int $userId
     * @param int $fanjydaId
     * @param string $dni
     * @param DateTime $birthDate
     * @param int $phone
     * @param string $email
     * @param string $diseases
     * @param int $trainerId
     * @param int $beltId
     * @param int $addressId
     * @param int $classId
     */
    public function __construct(
        string $name,
        string $surname,
        string $secondSurname,
        int $gender,
        int $id,
        int $userId,
        int $fanjydaId,
        string $dni,
        DateTime $birthDate,
        int $phone,
        string $email,
        string $diseases,
        int $trainerId,
        int $beltId,
        int $addressId,
        int $classId
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->secondSurname = $secondSurname;
        $this->gender = $gender;
        $this->id = $id;
        $this->userId = $userId;
        $this->fanjydaId = $fanjydaId;
        $this->dni = $dni;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
        $this->email = $email;
        $this->diseases = $diseases;
        $this->trainerId = $trainerId;
        $this->beltId = $beltId;
        $this->addressId = $addressId;
        $this->classId = $classId;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function surname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function secondSurname(): string
    {
        return $this->secondSurname;
    }

    /**
     * @return int
     */
    public function gender(): int
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function userId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function fanjydaId(): int
    {
        return $this->fanjydaId;
    }

    /**
     * @return string
     */
    public function dni(): string
    {
        return $this->dni;
    }

    /**
     * @return DateTime
     */
    public function birthDate(): DateTime
    {
        return $this->birthDate;
    }

    /**
     * @return int
     */
    public function phone(): int
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function diseases(): string
    {
        return $this->diseases;
    }

    /**
     * @return int
     */
    public function trainerId(): int
    {
        return $this->trainerId;
    }

    /**
     * @return int
     */
    public function beltId(): int
    {
        return $this->beltId;
    }

    /**
     * @return int
     */
    public function addressId(): int
    {
        return $this->addressId;
    }

    /**
     * @return int
     */
    public function classId(): int
    {
        return $this->classId;
    }
}
