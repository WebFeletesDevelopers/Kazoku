<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidUserIdException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;
use WebFeletesDevelopers\Kazoku\Utils\Utils;

/**
 * Class UserControllerMin
 * User controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class UserControllerMin
{
    private UserModel $model;
    private VerificationModel $verificationModel;
    private SendMailService $mailService;

    /**
     * UserController constructor.
     * @param UserModel $model
     * @param VerificationModel $verificationModel
     * @param SendMailService $mailService
     */
    public function __construct(
        UserModel $model
    ){
        $this->model = $model;
    }



    /**
     * Finds basic data of an user by it's ID
     * @param int $userId
     * @return array|null
     */
    public function findByIDmin(int $userId): ?array {
        try {
            return $this->model->findByIdmin($userId);
        } catch (InvalidUserIdException $e) {
        } catch (QueryException $e) {
        }
    }

    /**
     * Finds a user by its  but getting reduced data
     * @param int $rank
     * @return array|null
     */
    public function findByRankMin(int $rank): ?array {
        try {
            return $this->model->findByRankMin($rank);
        } catch (QueryException $e) {
        }
    }

    /**
     * Finds all users
     * @return array|null
     */
    public function findAllMin(): ?array {
        try {
            return $this->model->findAllMin();
        } catch (QueryException $e) {
        }
    }
}
