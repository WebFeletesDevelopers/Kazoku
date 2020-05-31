<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Centro
 * Center entity
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Centro
{
    private int $id;
    private string $name;
    private string $address;
    private int $zipCode;
    private int $phoneNumber;

    /**
     * Centro constructor.
     * @param int $id
     * @param string $name
     * @param string $address
     * @param int $zipCode
     * @param int $phoneNumber
     */
    public function __construct(
        int $id,
        string $name,
        string $address,
        int $zipCode,
        int $phoneNumber
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->phoneNumber = $phoneNumber;
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
    public function address(): string
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function zipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @return int
     */
    public function phoneNumber(): int
    {
        return $this->phoneNumber;
    }
}
