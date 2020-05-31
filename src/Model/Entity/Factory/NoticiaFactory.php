<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use DateTime;
use Exception;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;

class NoticiaFactory
{
    /**
     * @param array $rows
     * @return Noticia[]
     * @throws Exception
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            $date = new DateTime($row['date']);
            return new Noticia(
                $row['id'],
                $row['title'],
                $row['body'],
                $date,
                $row['author'],
                $row['public'] === '1'
            );
        }, $rows);
    }
}
