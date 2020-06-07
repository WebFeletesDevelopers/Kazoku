<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Verification
 * Verification entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Verification
{
    private int $id;
    private string $code;
    private int $user_id;

    /**
     * Verification constructor.
     * @param string $code
     * @param int $id
     * @param int $user_id
     */
    public function __construct(
        string $code,
        int $id,
        int $user_id
    ) {
        $this->code = $code;
        $this->id = $id;
        $this->user_id = $user_id;
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
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function userId(): int
    {
        return $this->user_id;
    }
}
