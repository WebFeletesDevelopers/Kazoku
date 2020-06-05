<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\UserFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

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
}
