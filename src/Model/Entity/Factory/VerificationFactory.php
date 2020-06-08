<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use WebFeletesDevelopers\Kazoku\Model\Entity\Verification;

/**
 * Class VerificationFactory
 * Factory for verification.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity\Factory
 */
class VerificationFactory
{
    /**
     * @param array $rows
     * @return Verification[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array &$row) {
            return new Verification(
                $row['id'],
                $row['code'],
                $row['user']
            );
        }, $rows);
    }
}
