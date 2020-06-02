<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use DateTime;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;

/**
 * Class NoticiaController
 * News controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class NoticiaController
{
    private NoticiaModel $model;

    /**
     * NoticiaController constructor.
     * @param NoticiaModel $model
     */
    public function __construct(NoticiaModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $title
     * @param string $body
     * @param DateTime $date
     * @param string $author
     * @param bool $isPublic
     * @return bool
     */
    public function addNews(
        string $title,
        string $body,
        DateTime $date,
        string $author,
        bool $isPublic
    ): bool {
        return $this->model->add($title, $body, $date, $author, $isPublic);
    }

    /**
     * @param int $length
     * @return Noticia[]
     */
    public function getLatestPublic(int $length = 5): array
    {
        return $this->model->getLatestPublic($length);
    }

    /**
     * @param int $length
     * @return array
     */
    public function getLatest(int $length = 5): array
    {
        return $this->model->getLatest($length);
    }
}
