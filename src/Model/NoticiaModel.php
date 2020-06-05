<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use DateTime;
use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\NoticiaFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\Noticia;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class NoticiaModel
 * News model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class NoticiaModel extends BaseModel
{
    /**
     * Insert a News into the database.
     * @param string $title
     * @param string $body
     * @param DateTime $date
     * @param string $author
     * @param bool $isPublic
     * @return bool
     * @throws QueryException
     */
    public function add(string $title, string $body, DateTime $date, User $author, bool $isPublic): bool
    {
        $sql = <<<SQL
        INSERT INTO noticias(Titulo, Cuerpo, Fecha, Autor, Publica)
        VALUES (?, ?, ?, ?, ?);
SQL;
        $binds = [
            $title,
            $body,
            $date->format(ConnectionHelper::MYSQL_DATE_FORMAT),
            $author->username(),
            $isPublic
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Deletes a new from the Database
     * @param int $CodNot
     * @return bool
     * @throws QueryException
     */
    public function delete(
        int $CodNot
    ): bool {
        $sql = <<<SQL
        DELETE FROM noticias WHERE `CodNot` = ?;
SQL;
        $binds = [
            $CodNot,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Get last public news
     * @param int $count
     * @param int $page
     * @return Noticia[]
     */
    public function getLatestPublic(int $count = 5, int $page = 1): array {
        $rows = $this->getNewsRows($count, $page, true);
        return NoticiaFactory::fromMysqlRows($rows);
    }

    /**
     * Get last news
     * @param int $count
     * @param int $page
     * @return array
     */
    public function getLatest(int $count = 5, int $page = 1): array {
        $rows = $this->getNewsRows($count, $page, false);
        return NoticiaFactory::fromMysqlRows($rows);
    }

    /**
     * Query builder for news select
     * @param int $count
     * @param int $page
     * @param bool $onlyPublic
     * @return array
     */
    private function getNewsRows(int $count, int $page, bool $onlyPublic): array
    {
        $preSql = <<<SQL
        SELECT n.CodNot AS id,
               n.Titulo AS title,
               n.Cuerpo AS body,
               n.Fecha AS date,
               n.Autor AS author,
               n.Publica AS public
        FROM noticias n
        %s
        ORDER BY n.Fecha DESC
        LIMIT ?, ?
SQL;
        $where = $onlyPublic === true
            ? 'WHERE n.Publica = 1'
            : '';

        $sql = sprintf($preSql, $where);

        $offset = $page === 1
            ? 0
            : ($page - 1) * $count;

        try {
            $statement = $this->query($sql, [$offset, $count]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return $rows;
    }
}
