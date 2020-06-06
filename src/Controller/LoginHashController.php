<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\LoginHashModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class LoginHashController
 * Controller used to manage login hashes.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class LoginHashController
{
    private UserModel $userModel;
    private LoginHashModel $hashModel;

    /**
     * LoginHashController constructor.
     * @param UserModel $userModel
     * @param LoginHashModel $hashModel
     */
    public function __construct(
        UserModel $userModel,
        LoginHashModel $hashModel
    ) {
        $this->userModel = $userModel;
        $this->hashModel = $hashModel;
    }

    /**
     * @param string $username
     * @param string $password
     * @return string
     * @throws QueryException
     * @throws InvalidCredentialsException
     */
    public function getHashFromLoginData(string $username, string $password): string
    {
        $user = $this->userModel->findByLoginData($username, $password);
        return $this->hashModel->createForUser($user);
    }
}
