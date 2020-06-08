<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;

/**
 * Class UserController
 * User controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class UserController
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
        UserModel $model,
        VerificationModel $verificationModel,
        SendMailService $mailService
    ){
        $this->model = $model;
        $this->verificationModel = $verificationModel;
        $this->mailService = $mailService;
    }

    /**
     * @param int $rank
     * @param string $username
     * @param string $name
     * @param string $phone
     * @param string $surname
     * @param string $secondSurname
     * @param string $password
     * @param string $email
     * @return User
     * @throws QueryException
     */
    public function register(
        int $rank,
        string $username,
        string $name,
        string $phone,
        string $surname,
        string $secondSurname,
        string $password,
        string $email
    ): User {
        $user = $this->model->create($rank,
            $username,
            $name,
            $phone,
            $surname,
            $secondSurname,
            $password,
            $email
        );
        if ($user) {
            var_dump($user);
             $verification = $this->verificationModel->createForUser($user);
             if ($verification) {
                 var_dump($verification);
                $this->mailService->sendRegisterMail($user, $verification);
             }
        }
        return $user;
    }

    /**
     * Activate an user email.
     * @param string $code
     * @return User
     * @throws QueryException
     * @throws InvalidCredentialsException
     */
    public function activateByEmail(string $code): User
    {
        $user = $this->model->findByEmailActivation($code);
        if ($user) {
            $user->setConfirmedMail(true);
            $this->model->updateWithoutHash($user);
        }
        return $user;
    }
}
