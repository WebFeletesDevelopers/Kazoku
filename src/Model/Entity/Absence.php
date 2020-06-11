<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

/**
 * Class Verification
 * Verification entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Absence
{
    private int $id;
    private int $userId;
    private int $classId;
    private string $date;


    public function __construct(
        ?int $id,
        int $userId,
        int $classId,
        string $date
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->classId = $classId;
        $this->date = $date;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getClassId(): int
    {
        return $this->classId;
    }

    /**
     * @param int $classId
     */
    public function setClassId(int $classId): void
    {
        $this->classId = $classId;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

}
