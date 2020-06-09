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
    private string $lastname;
    private string $secondLastname;
    private int $gender;
    private int $id;
    private int $userId;
    private int $fanjydaId;
    private string $dni;
    private DateTime $birthDate;
    private int $phone;
    private string $email;
    private string $illness;
    private int $parentId;
    private int $beltId;
    private int $addressId;
    private int $classId;

    /**
     * Alumno constructor.
     * @param string $name
     * @param string $lastname
     * @param string $secondLastname
     * @param int $gender
     * @param int $id
     * @param int $userId
     * @param int $fanjydaId
     * @param string $dni
     * @param string $birthDate
     * @param int $phone
     * @param string $email
     * @param string $illness
     * @param int $parentId
     * @param int $beltId
     * @param int $addressId
     * @param int $classId
     */
    public function __construct(
        string $name,
        string $lastname,
        string $secondLastname,
        int $gender,
        int $id,
        ?int $userId,
        ?int $fanjydaId,
        ?string $dni,
        string $birthDate,
        int $phone,
        string $email,
        ?string $illness,
        ?int $parentId,
        int $beltId,
        int $addressId,
        int $classId
    ) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->secondLastname = $secondLastname;
        $this->gender = $gender;
        $this->id = $id;
        $this->userId = $userId;
        $this->fanjydaId = $fanjydaId;
        $this->dni = $dni;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
        $this->email = $email;
        $this->illness = $illness;
        $this->parentId = $parentId;
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
    public function lastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function secondLastname(): string
    {
        return $this->secondLastname;
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
    public function illness(): string
    {
        return $this->illness;
    }

    /**
     * @return int
     */
    public function parentId(): int
    {
        return $this->parentId;
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
