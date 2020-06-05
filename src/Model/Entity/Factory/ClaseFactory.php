<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use WebFeletesDevelopers\Kazoku\Model\Entity\Clase;

class ClaseFactory
{
    /**
     * @param array $rows
     * @return Clase[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            return new Clase(
                $row['schedule'],
                $row['trainer'],
                $row['minAge'],
                $row['maxAge'],
                $row['name'],
                $row['centerId'],
                $row['days']
            );
        }, $rows);
    }
}
