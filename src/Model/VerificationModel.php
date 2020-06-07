<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\VerificationFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\Verification;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class VerificationModel
 * Verification model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class VerificationModel extends BaseModel
{
    public function getFromCode(string $code): Verification
    {
        $sql = <<<SQL
        SELECT v.id AS id,
               v.code AS code,
               v.user_id AS user_id
        FROM verification v
        WHERE v.code = ?
SQL;

        $binds = [$code];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        $rows = $statement->fetchAll();
        return VerificationFactory::fromMysqlRows($rows)[0];
    }
}
