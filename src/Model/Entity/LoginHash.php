<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class LoginHash
 * Login hash entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class LoginHash
{
    private int $id;
    private string $hash;
    private int $userId;

    /**
     * LoginHash constructor.
     * @param int $id
     * @param string $hash
     * @param int $userId
     */
    public function __construct(
        int $id,
        string $hash,
        int $userId
    ) {
        $this->id = $id;
        $this->hash = $hash;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
