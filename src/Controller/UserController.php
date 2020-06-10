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
             $verification = $this->verificationModel->createForUser($user);
             if ($verification) {
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
            $this->verificationModel->deleteByCode($code);
        }
        return $user;
    }

    /**
     * Activate an user.
     * @param string $userId
     * @param string $hash
     * @return User
     * @throws QueryException
     * @throws InvalidHashException
     * @throws InvalidUserIdException
     */
    public function activateByTrainer(string $userId, string $hash): User
    {
        $trainer = $this->model->findByHash($hash);
        if (! in_array($trainer->rank(), Rank::TRAINER_RANKS, true)) {
            //fixme 403
            die;
        }
        $user = $this->model->findById($userId);
        $user->setConfirmed(true);
        $this->model->updateWithoutHash($user);
        return $user;
    }

    /**
     * @param string $userId
     * @param string $hash
     * @return bool
     * @throws InvalidHashException
     * @throws InvalidUserIdException
     * @throws QueryException
     */
    public function deleteByTrainer(string $userId, string $hash): bool
    {
        $trainer = $this->model->findByHash($hash);
        if (! in_array($trainer->rank(), Rank::TRAINER_RANKS, true)) {
            //fixme 403
            die;
        }
        $user = $this->model->findById($userId);
        $this->model->delete($user);
        return true;
    }

    /**
     * List not confirmed users.
     * @param string $hash
     * @return array
     * @throws InvalidHashException
     * @throws QueryException
     */
    public function listNotConfirmed(string $hash): array
    {
        $trainer = $this->model->findByHash($hash);
        if (! in_array($trainer->rank(), Rank::TRAINER_RANKS, true)) {
            //fixme 403
            die;
        }
        return $this->model->find();
    }

    /**
     * Start a mail recovery.
     * @param string $email
     * @return User
     * @throws InvalidCredentialsException
     * @throws QueryException
     */
    public function startMailRecovery(string $email): User
    {
        $user = $this->model->findByEmail($email);
        if ($user) {
            $verification = $this->verificationModel->createForUser($user);
            if ($verification) {
                $this->mailService->sendRecoveryMail($user, $verification);
            }
        }
        return $user;
    }

    /**
     * Update an user password for recovery.
     * @param string $hash
     * @param string $password
     * @return User
     * @throws InvalidCredentialsException
     * @throws QueryException
     */
    public function updatePasswordFromRecovery(string $hash, string $password): User
    {
        $user = $this->model->findByEmailActivation($hash);
        if ($user) {
            $user->setPassword(Utils::hashPassword($password));
            $this->model->updateWithoutHash($user);
            $this->verificationModel->deleteByCode($hash);
        }
        return $user;
    }
}
