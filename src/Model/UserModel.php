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
        SELECT u.id AS id,
               u.confirmed AS confirmed,
               u.rank AS `rank`,
               u.username AS username,
               u.name AS name,
               u.phone AS phone,
               u.surname AS surname,
               u.second_surname AS secondSurname,
               u.password AS password,
               u.email AS email,
               u.email_confirmed AS confirmedMail
        FROM users u
        INNER JOIN login_hash lh ON u.id = lh.user_id
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
        SELECT u.id AS id,
               u.confirmed AS confirmed,
               u.rank AS `rank`,
               u.username AS username,
               u.name AS name,
               u.phone AS phone,
               u.surname AS surname,
               u.second_surname AS secondSurname,
               u.password AS password,
               u.email AS email,
               u.email_confirmed AS confirmedMail
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
        SELECT u.id AS id,
               u.confirmed AS confirmed,
               u.rank AS `rank`,
               u.username AS username,
               u.name AS name,
               u.phone AS phone,
               u.surname AS surname,
               u.second_surname AS secondSurname,
               u.password AS password,
               u.email AS email,
               u.email_confirmed AS confirmedMail
        FROM users u
        INNER JOIN verification v on u.id = v.user_id
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
        INSERT INTO users(`rank`, username, name, phone, surname, second_surname, password, email)
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
            confirmed = ?,
            rank = ?,
            username = ?,
            name = ?,
            phone = ?,
            surname = ?,
            second_surname = ?,
            password = ?,
            email = ?,
            email_confirmed = ?
        WHERE id = ?
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
        SELECT u.id AS id,
               u.confirmed AS confirmed,
               u.rank AS `rank`,
               u.username AS username,
               u.name AS name,
               u.phone AS phone,
               u.surname AS surname,
               u.second_surname AS secondSurname,
               u.password AS password,
               u.email AS email,
               u.email_confirmed AS confirmedMail
        FROM users u
        WHERE u.id = ?
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
        SELECT u.id AS id,
               u.confirmed AS confirmed,
               u.rank AS `rank`,
               u.username AS username,
               u.name AS name,
               u.phone AS phone,
               u.surname AS surname,
               u.second_surname AS secondSurname,
               u.password AS password,
               u.email AS email,
               u.email_confirmed AS confirmedMail
        FROM users u
        WHERE u.confirmed = 0
SQL;

        $statement = $this->query($sql, []);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, []);
        }

        $rows = $statement->fetchAll();

        return UserFactory::fromMysqlRows($rows);
    }

    /**
     * @param int $rank
     * @return User[]
     * @throws QueryException
     */
    public function findByRank(int $rank): array
    {
        {
            $sql = <<<SQL
        SELECT u.id AS id,
               u.confirmed AS confirmed,
               u.rank AS `rank`,
               u.username AS username,
               u.name AS name,
               u.phone AS phone,
               u.surname AS surname,
               u.second_surname AS secondSurname,
               u.password AS password,
               u.email AS email,
               u.email_confirmed AS confirmedMail
        FROM users u
        WHERE u.rank = ?
SQL;

            $binds = [$rank];

            $statement = $this->query($sql, $binds);
            if ($statement === false) {
                throw QueryException::fromFailedQuery($sql, []);
            }

            $rows = $statement->fetchAll();

            return UserFactory::fromMysqlRows($rows);
        }
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
        WHERE id = ?
SQL;

        $binds = [$user->id()];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }
}
