<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class User
 * User entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class User
{
    private bool $confirmed;
    private int $rank;
    private int $id;
    private string $username;
    private string $name;
    private ?string $phone;
    private string $surname;
    private ?string $secondSurname;
    private string $password;
    private string $email;
    private bool $confirmedMail;

    /**
     * User constructor.
     * @param bool $confirmed
     * @param int $rank
     * @param int $id
     * @param string $username
     * @param string $name
     * @param string $phone
     * @param string $surname
     * @param string $secondSurname
     * @param string $password
     * @param string $email
     * @param bool $confirmedMail
     */
    public function __construct(
        bool $confirmed,
        int $rank,
        int $id,
        string $username,
        string $name,
        ?string $phone,
        string $surname,
        ?string $secondSurname,
        string $password,
        string $email,
        bool $confirmedMail
    ) {
        $this->confirmed = $confirmed;
        $this->rank = $rank;
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->phone = $phone;
        $this->surname = $surname;
        $this->secondSurname = $secondSurname;
        $this->password = $password;
        $this->email = $email;
        $this->confirmedMail = $confirmedMail;
    }

    /**
     * @return bool
     */
    public function confirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * @return int
     */
    public function rank(): int
    {
        return $this->rank;
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
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function phone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function surname(): string
    {
        return $this->surname;
    }

    /**
     * @return string|null
     */
    public function secondSurname(): ?string
    {
        return $this->secondSurname;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function confirmedMail(): bool
    {
        return $this->confirmedMail;
    }

    /**
     * @param bool $confirmed
     */
    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @param int $rank
     */
    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @param string|null $secondSurname
     */
    public function setSecondSurname(?string $secondSurname): void
    {
        $this->secondSurname = $secondSurname;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param bool $confirmedMail
     */
    public function setConfirmedMail(bool $confirmedMail): void
    {
        $this->confirmedMail = $confirmedMail;
    }
}
