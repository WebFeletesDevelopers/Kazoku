<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class UserController
 * User controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class UserController
{
    private UserModel $model;

    /**
     * UserController constructor.
     * @param UserModel $model
     */
    public function __construct(UserModel $model)
    {
        $this->model = $model;
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
     * @return bool
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
    ): bool {
        return $this->model->create($rank,
            $username,
            $name,
            $phone,
            $surname,
            $secondSurname,
            $password,
            $email
        );
    }
}
