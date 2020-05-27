<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Tutor
 * Trainer entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Tutor
{
    private int $id;
    private string $name;
    private string $surname;
    private string $secondSurname;
    private int $phoneNumber;
    private string $DNI;
    private int $addressId;
    private string $email;

    /**
     * Tutor constructor.
     * @param int $id
     * @param string $name
     * @param string $surname
     * @param string $secondSurname
     * @param int $phoneNumber
     * @param string $DNI
     * @param int $addressId
     * @param string $email
     */
    public function __construct(
        int $id,
        string $name,
        string $surname,
        string $secondSurname,
        int $phoneNumber,
        string $DNI,
        int $addressId,
        string $email
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->secondSurname = $secondSurname;
        $this->phoneNumber = $phoneNumber;
        $this->DNI = $DNI;
        $this->addressId = $addressId;
        $this->email = $email;
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
    public function phoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function DNI(): string
    {
        return $this->DNI;
    }

    /**
     * @return int
     */
    public function addressId(): int
    {
        return $this->addressId;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
