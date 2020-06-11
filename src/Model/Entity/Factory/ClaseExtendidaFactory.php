<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use WebFeletesDevelopers\Kazoku\Model\Entity\ClaseExtendida;
use Exception;


class ClaseExtendidaFactory
{
    /**
     * @param array $rows
     * @return Clase[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            return new ClaseExtendida(
                $row['id'],
                $row['schedule'],
                $row['trainer'],
                $row['minAge'],
                $row['maxAge'],
                $row['name'],
                $row['centerId'],
                $row['days'],
                $row['centerName'],
                $row['centerSt'],
                $row['centerTel'],
                $row['judokas']
            );
        }, $rows);
    }
}
