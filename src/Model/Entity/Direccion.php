<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Direccion
 * Address entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Direccion
{
    private int $id;
    private int $zipCode;
    private string $city;
    private string $province;
    private string $address;

    /**
     * Direccion constructor.
     * @param int $id
     * @param int $zipCode
     * @param string $city
     * @param string $province
     * @param string $address
     */
    public function __construct(
        int $id,
        int $zipCode,
        string $city,
        string $province,
        string $address
    ) {
        $this->id = $id;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->province = $province;
        $this->address = $address;
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
    public function zipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function province(): string
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }
}
