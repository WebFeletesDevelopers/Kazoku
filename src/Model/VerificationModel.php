<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Entity\Verification;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Utils\Utils;

/**
 * Class VerificationModel
 * Verification model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class VerificationModel extends BaseModel
{
    /**
     * Create a verification code for an user.
     * @param User $user
     * @return Verification
     * @throws QueryException
     */
    public function createForUser(User $user): Verification
    {
        $sql = <<<SQL
        INSERT INTO verification(code, user_id)
        VALUES (?, ?)
SQL;

        $code = Utils::generateRandomString(64);
        $binds = [$code, $user->id()];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return new Verification($code, $this->db->lastInsertId(), $user->id());
    }
}
