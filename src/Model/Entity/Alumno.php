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
    private ?int $userId;
    private ?int $fanjydaId;
    private ?string $dni;
    private DateTime $birthDate;
    private ?int $phone;
    private ?string $email;
    private ?string $illness;
    private ?int $parentId;
    private int $beltId;
    private ?int $addressId;
    private ?int $classId;

    /**
     * Alumno constructor.
     * @param string $name
     * @param string $lastname
     * @param string $secondLastname
     * @param int $gender
     * @param int $id
     * @param int|null $userId
     * @param int|null $fanjydaId
     * @param string|null $dni
     * @param string $birthDate
     * @param int|null $phone
     * @param string|null $email
     * @param string|null $illness
     * @param int|null $parentId
     * @param int $beltId
     * @param int|null $addressId
     * @param int|null $classId
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
        ?int $phone,
        ?string $email,
        ?string $illness,
        ?int $parentId,
        int $beltId,
        ?int $addressId,
        ?int $classId
    ) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->secondLastname = $secondLastname;
        $this->gender = $gender;
        $this->id = $id;
        $this->userId = $userId;
        $this->fanjydaId = $fanjydaId;
        $this->dni = $dni;
        $this->birthDate = new DateTime($birthDate);
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
     * @return int|null
     */
    public function userId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return int|null
     */
    public function fanjydaId(): ?int
    {
        return $this->fanjydaId;
    }

    /**
     * @return string|null
     */
    public function dni(): ?string
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
     * @return int|null
     */
    public function phone(): ?int
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function email(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function illness(): ?string
    {
        return $this->illness;
    }

    /**
     * @return int|null
     */
    public function parentId(): ?int
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
     * @return int|null
     */
    public function addressId(): ?int
    {
        return $this->addressId;
    }

    /**
     * @return int|null
     */
    public function classId(): ?int
    {
        return $this->classId;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @param string $secondLastname
     */
    public function setSecondLastname(string $secondLastname): void
    {
        $this->secondLastname = $secondLastname;
    }

    /**
     * @param int $gender
     */
    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param int|null $fanjydaId
     */
    public function setFanjydaId(?int $fanjydaId): void
    {
        $this->fanjydaId = $fanjydaId;
    }

    /**
     * @param string|null $dni
     */
    public function setDni(?string $dni): void
    {
        $this->dni = $dni;
    }

    /**
     * @param DateTime $birthDate
     */
    public function setBirthDate(DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @param int|null $phone
     */
    public function setPhone(?int $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string|null $illness
     */
    public function setIllness(?string $illness): void
    {
        $this->illness = $illness;
    }

    /**
     * @param int|null $parentId
     */
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @param int $beltId
     */
    public function setBeltId(int $beltId): void
    {
        $this->beltId = $beltId;
    }

    /**
     * @param int|null $addressId
     */
    public function setAddressId(?int $addressId): void
    {
        $this->addressId = $addressId;
    }

    /**
     * @param int|null $classId
     */
    public function setClassId(?int $classId): void
    {
        $this->classId = $classId;
    }
}
