<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use WebFeletesDevelopers\Kazoku\Model\Entity\Centro;
use Exception;


class CentroFactory
{
    /**
     * @param array $rows
     * @return Centro[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            return new Centro(
                $row['centerId'],
                $row['name'],
                $row['direction'],
                $row['zip'],
                $row['phone']
            );
        }, $rows);
    }
}
