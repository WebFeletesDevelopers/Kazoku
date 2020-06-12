<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use DateTime;
use Exception;
use WebFeletesDevelopers\Kazoku\Model\Entity\Direccion;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;

/**
 * Class AddressFactory
 * @package WebFeletesDevelopers\Kazoku\Model\Entity\Factory
 */
class AddressFactory
{
    /**
     * @param array $rows
     * @return Direccion[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            return new Direccion(
                $row['id'],
                $row['zip'],
                $row['locality'],
                $row['province'],
                $row['address']
            );
        }, $rows);
    }
}
