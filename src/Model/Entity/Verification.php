<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Verification
 * Verification entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Verification
{
    private string $code;
    private int $id;
    private string $uname;
    private bool $confirmed;

    /**
     * Verification constructor.
     * @param string $code
     * @param int $id
     * @param string $uname
     * @param bool $confirmed
     */
    public function __construct(
        string $code,
        int $id,
        string $uname,
        bool $confirmed
    ) {
        $this->code = $code;
        $this->id = $id;
        $this->uname = $uname;
        $this->confirmed = $confirmed;
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
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function uname(): string
    {
        return $this->uname;
    }

    /**
     * @return bool
     */
    public function confirmed(): bool
    {
        return $this->confirmed;
    }
}
