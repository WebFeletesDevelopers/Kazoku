<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use DateTime;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;
use WebFeletesDevelopers\Kazoku\Model\Exception\InsertException;

/**
 * Class NoticiaModel
 * News model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class NoticiaModel extends BaseModel
{
    /**
     * @param string $title
     * @param string $body
     * @param DateTime $date
     * @param string $author
     * @param bool $isPublic
     * @return bool
     * @throws InsertException
     */
    public function add(
        string $title,
        string $body,
        DateTime $date,
        string $author,
        bool $isPublic
    ): bool {
        $sql = <<<SQL
        INSERT INTO noticias(Titulo, Cuerpo, Fecha, Autor, Publica)
        VALUES (?, ?, ?, ?, ?);
SQL;
        $binds = [
            $title,
            $body,
            $date->format(ConnectionHelper::MYSQL_DATE_FORMAT),
            $author,
            $isPublic
        ];
        $statement = $this->query($sql, $binds);

        if ($statement === false) {
            throw InsertException::fromFailedInsert($sql, $binds);
        }

        return true;
    }
}
