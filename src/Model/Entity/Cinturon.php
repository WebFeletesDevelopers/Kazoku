<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Cinturon
 * Belt entity
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Cinturon
{
    private int $id;
    private string $belt;

    /**
     * Cinturon constructor.
     * @param int $id
     * @param string $belt
     */
    public function __construct(
        int $id,
        string $belt
    ) {
        $this->id = $id;
        $this->belt = $belt;
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
    public function belt(): string
    {
        return $this->belt;
    }
}
