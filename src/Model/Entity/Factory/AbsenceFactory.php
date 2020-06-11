<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use WebFeletesDevelopers\Kazoku\Model\Entity\Absence;

/**
 * Class AbsenceFactory
 * Factory for Absence.
 * @package WebFeletesDevelopers\Kazoku\Model\Entity\Factory
 */
class AbsenceFactory
{
    /**
     * @param array $rows
     * @return Verification[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array &$row) {
            return new Absence(
                $row['id'],
                $row['userId'],
                $row['classId'],
                $row['date']
            );
        }, $rows);
    }
}
