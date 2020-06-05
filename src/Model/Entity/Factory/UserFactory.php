<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use WebFeletesDevelopers\Kazoku\Model\Entity\User;

/**
 * Class UserFactory
 * @package WebFeletesDevelopers\Kazoku\Model\Entity\Factory
 */
class UserFactory
{
    /**
     * @param array $rows
     * @return User[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            return new User(
                $row['confirmed'] === '1',
                $row['rank'],
                $row['id'],
                $row['username'],
                $row['name'],
                $row['phone'],
                $row['surname'],
                $row['secondSurname'],
                $row['password'],
                $row['email'],
                $row['confirmedEmail'] === '1'
            );
        }, $rows);
    }
}
