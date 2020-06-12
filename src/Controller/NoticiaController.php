<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use DateTime;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class NoticiaController
 * News controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class NoticiaController
{
    private NoticiaModel $noticiaModel;
    private UserModel $userModel;

    /**
     * NoticiaController constructor.
     * @param NoticiaModel $noticiaModel
     * @param UserModel $userModel
     */
    public function __construct(
        NoticiaModel $noticiaModel,
        UserModel $userModel
    ) {
        $this->noticiaModel = $noticiaModel;
        $this->userModel = $userModel;
    }

    /**
     * @param string $title
     * @param string $body
     * @param DateTime $date
     * @param bool $isPublic
     * @param string $userHash
     * @return bool
     * @throws QueryException
     * @throws InvalidHashException
     */
    public function addNews(
        string $title,
        string $body,
        DateTime $date,
        bool $isPublic,
        string $userHash
    ): bool {
        $user = $this->userModel->findByHash($userHash);
        return $this->noticiaModel->add($title, $body, $date, $user, $isPublic);
    }

    /**
     * Function that brings the  5 lasted news
     * @param int $length
     * @return Noticia[]
     */
    public function getLatestPublic(int $length = 5): array
    {
        return $this->noticiaModel->getLatestPublic($length);
    }

    /**
     * @param int $length
     * @return array
     */
    public function getLatest(int $length = 5): array
    {
        return $this->noticiaModel->getLatest($length);
    }

    public function deleteNews(
        int $codNot
    ): bool {
        return $this->noticiaModel->delete($codNot);
    }

}
