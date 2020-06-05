<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Utils\Utils;

/**
 * Class LoginHashModel
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class LoginHashModel extends BaseModel
{
    /**
     * @param User $user
     * @return bool
     * @throws QueryException
     */
    public function createForUser(User $user): bool
    {
        $sql = <<<SQL
        INSERT INTO login_hash(hash, user_id)
        VALUES (?, ?);
SQL;
        $hash = Utils::generateRandomString(64);
        $binds = [$hash, $user->id()];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * @param User $user
     * @param string $hash
     * @return bool
     * @throws QueryException
     * @throws InvalidHashException
     */
    public function validateForUser(User $user, string $hash): bool
    {
        $sql = <<<SQL
        SELECT id
            FROM login_hash 
            WHERE user_id = ?
              AND hash = ?
SQL;
        $binds = [$user->id(), $hash];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        if ($statement->rowCount() === 0) {
            throw InvalidHashException::fromInvalidHash();
        }

        return true;
    }
}
