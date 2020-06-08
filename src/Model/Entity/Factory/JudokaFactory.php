<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use DateTime;
use Exception;
use WebFeletesDevelopers\Kazoku\Model\Entity\Alumno;
use WebFeletesDevelopers\Kazoku\Model\Entity\Judoka;

/**
 * Class JudokaFactory
 * @package WebFeletesDevelopers\Kazoku\Model\Entity\Factory
 */
class JudokaFactory
{
    /**
     * @param array $rows
     * @return Alumno[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            try {
                $date = new DateTime($row['date']);
            } catch (Exception $e) {
                $date = new DateTime();
            }
            return new Alumno(
                $row['name'],
                $row['lastName1'],
                $row['lastName2'],
                $row['sex'],
                $row['judokaId'],
                $row['userId'],
                $row['fanjydaId'],
                $row['dni'],
                $row['birthDate'],
                $row['phone'],
                $row['email'],
                $row['illness'],
                $row['parentId'],
                $row['beltId'],
                $row['addressId'],
                $row['classId']
            );
        }, $rows);
    }
}
