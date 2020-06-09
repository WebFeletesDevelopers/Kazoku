<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\UserFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidUserIdException;
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
     * Find user by email activation token
     * @param string $code
     * @return User
     * @throws InvalidCredentialsException
     * @throws QueryException
     */
    public function findByEmailActivation(string $code): User
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
        INNER JOIN verification v on u.CodUsu = v.user_id
        WHERE v.code = ?
SQL;

        $binds = [$code];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        if ($statement->rowCount() === 0) {
            throw InvalidCredentialsException::fromInvalidCredentials();
        }

        $rows = $statement->fetchAll();

        return UserFactory::fromMysqlRows($rows)[0];
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
     * @return User Inserted user
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
    ): User {
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

        return new User(
            false,
            $rank,
            $this->db->lastInsertId(),
            $username,
            $name,
            $phone,
            $surname,
            $secondSurname,
            $hash,
            $email,
            false
        );
    }

    /**
     * Update an user without checking the requester login hash.
     * @param User $user
     * @return User
     * @throws QueryException
     */
    public function updateWithoutHash(
        User $user
    ): User {
        $sql =<<<SQL
        UPDATE users SET
            Confirmado = ?,
            Rango = ?,
            username = ?,
            name = ?,
            Telefono = ?,
            Apellido1 = ?,
            Apellido2 = ?,
            password = ?,
            Email = ?,
            EmailConfirmado = ?
        WHERE CodUsu = ?
SQL;

        $binds = [
            $user->confirmed(),
            $user->rank(),
            $user->username(),
            $user->name(),
            $user->phone(),
            $user->surname(),
            $user->secondSurname(),
            $user->password(),
            $user->email(),
            $user->confirmedMail(),
            $user->id(),
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return $user;
    }

    /**
     * @param int $userId
     * @return User
     * @throws QueryException
     * @throws InvalidUserIdException
     */
    public function findById(int $userId): User
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
        WHERE u.CodUsu = ?
SQL;
        $binds = [$userId];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        if ($statement->rowCount() === 0) {
            throw InvalidUserIdException::fromInvalidId($userId);
        }

        $rows = $statement->fetchAll();

        return UserFactory::fromMysqlRows($rows)[0];
    }

    /**
     * @return User[]
     * @throws QueryException
     */
    public function find(): array
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
        WHERE u.Confirmado = 0
SQL;

        $statement = $this->query($sql, []);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, []);
        }

        $rows = $statement->fetchAll();

        return UserFactory::fromMysqlRows($rows);
    }

    /**
     * @param User $user
     * @return bool
     * @throws QueryException
     */
    public function delete(User $user): bool
    {
        $sql =<<<SQL
        DELETE FROM users
        WHERE CodUsu = ?
SQL;

        $binds = [$user->id()];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }
}
