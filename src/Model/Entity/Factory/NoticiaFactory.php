<?php

namespace WebFeletesDevelopers\Kazoku\Model\Entity\Factory;

use DateTime;
use Exception;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;

/**
 * Class NoticiaFactory
 * @package WebFeletesDevelopers\Kazoku\Model\Entity\Factory
 */
class NoticiaFactory
{
    /**
     * @param array $rows
     * @return Noticia[]
     */
    public static function fromMysqlRows(array &$rows): array
    {
        return array_map(static function (array $row) {
            try {
                $date = new DateTime($row['date']);
            } catch (Exception $e) {
                $date = new DateTime();
            }
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
