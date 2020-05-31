<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use DateTime;
use Exception;
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
        //fixme this should be in the model.
        try {
            $result = $this->model->add($title, $body, $date, $author, $isPublic);
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }

    /**
     * @param int $length
     * @return Noticia[]
     */
    public function getLastPublic(int $length = 5): array
    {
        return $this->model->getLastPublic($length);
    }
}
