<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\UserFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\UserNotConfirmedException;
use WebFeletesDevelopers\Kazoku\Utils\Utils;

/**
 * Class UserModel
 * User model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class UserModel extends BaseModel
{
    /**
     * @param string $hash
     * @return User
     * @throws InvalidHashException
     * @throws QueryException
     */
    public function findByHash(string $hash): User
    {
        $sql = <<<SQL
        SELECT u.Confirmado AS confirmed,
               u.Rango AS `rank`,
               u.CodUsu AS id,
               u.username AS username,
               u.name AS name,
               u.Telefono AS phone,
               u.Apellido1 AS surname,
               u.Apellido2 AS secondSurname,
               u.password AS password,
               u.Email AS email,
               u.EmailConfirmado AS confirmedMail
        FROM users u
        INNER JOIN login_hash lh ON u.CodUsu = lh.user_id
        WHERE lh.hash = ?;
SQL;
        $binds = [$hash];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        if ($statement->rowCount() === 0) {
            throw InvalidHashException::fromInvalidHash();
        }

        $rows = $statement->fetchAll();

        return UserFactory::fromMysqlRows($rows)[0];
    }

    /**
     * @param string $user
     * @param string $password
     * @return User
     * @throws QueryException
     * @throws InvalidCredentialsException
     * @throws UserNotConfirmedException
     */
    public function findConfirmedByLoginData(string $user, string $password): User
    {
        $sql = <<<SQL
        SELECT u.Confirmado AS confirmed,
               u.Rango AS `rank`,
               u.CodUsu AS id,
               u.username AS username,
               u.name AS name,
               u.Telefono AS phone,
               u.Apellido1 AS surname,
               u.Apellido2 AS secondSurname,
               u.password AS password,
               u.Email AS email,
               u.EmailConfirmado AS confirmedMail
        FROM users u
        WHERE u.username = ?
          AND u.password = ?
SQL;

        $hash = Utils::hashPassword($password);
        $binds = [$user, $hash];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        if ($statement->rowCount() === 0) {
            throw InvalidCredentialsException::fromInvalidCredentials();
        }

        $rows = $statement->fetchAll();

        $user = UserFactory::fromMysqlRows($rows)[0];

        if ($user->confirmed() === false || $user->confirmedMail() === false) {
            throw UserNotConfirmedException::fromNotConfirmedUser($user->username());
        }
        return $user;
    }

    /**
     * Add an user to the database.
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
    public function create(
        int $rank,
        string $username,
        string $name,
        string $phone,
        string $surname,
        string $secondSurname,
        string $password,
        string $email
    ): bool {
        $sql = <<<SQL
        INSERT INTO users(Rango, username, name, Telefono, Apellido1, Apellido2, password, Email)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
SQL;

        $hash = Utils::hashPassword($password);
        $binds = [
            $rank,
            $username,
            $name,
            $phone,
            $surname,
            $secondSurname,
            $hash,
            $email
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }
}
