<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity;

use DateTime;

/**
 * Class Noticia
 * News entity.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity
 */
class Noticia
{
    private int $id;
    private string $title;
    private string $body;
    private DateTime $date;
    private string $author;
    private bool $isPublic;

    /**
     * Noticia constructor.
     * @param int $id
     * @param string $title
     * @param string $body
     * @param DateTime $date
     * @param string $author
     * @param bool $isPublic
     */
    public function __construct(
        int $id,
        string $title,
        string $body,
        DateTime $date,
        string $author,
        bool $isPublic
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->date = $date;
        $this->author = $author;
        $this->isPublic = $isPublic;
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
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * @return DateTime
     */
    public function date(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function author(): string
    {
        return $this->author;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->isPublic;
    }
}
