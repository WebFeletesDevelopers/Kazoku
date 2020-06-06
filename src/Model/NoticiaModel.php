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
     * @param User $author
     * @param bool $isPublic
     * @return bool
     * @throws QueryException
     */
    public function add(string $title, string $body, DateTime $date, User $author, bool $isPublic): bool
    {
        $sql = <<<SQL
        INSERT INTO noticias(Titulo, Cuerpo, Fecha, user_id, Publica)
        VALUES (?, ?, ?, ?, ?);
SQL;
        $binds = [
            $title,
            $body,
            $date->format(ConnectionHelper::MYSQL_DATE_FORMAT),
            $author->id(),
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
        $sql = <<<SQL
        SELECT n.CodNot AS id,
               n.Titulo AS title,
               n.Cuerpo AS body,
               n.Fecha AS date,
               u.name AS author,
               n.Publica AS public
        FROM noticias n
        INNER JOIN users u
            ON n.user_id = u.CodUsu
        WHERE n.Publica = 1
        ORDER BY n.Fecha DESC
        LIMIT ?, ?
SQL;

        $offset = $page === 1
            ? 0
            : ($page - 1) * $count;

        try {
            $statement = $this->query($sql, [$offset, $count]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return NoticiaFactory::fromMysqlRows($rows);
    }

    /**
     * Get last news
     * @param int $count
     * @param int $page
     * @return array
     */
    public function getLatest(int $count = 5, int $page = 1): array {
        $sql = <<<SQL
        SELECT n.CodNot AS id,
               n.Titulo AS title,
               n.Cuerpo AS body,
               n.Fecha AS date,
               u.name AS author,
               n.Publica AS public
        FROM noticias n
        INNER JOIN users u
            ON n.user_id = u.CodUsu
        ORDER BY n.Fecha DESC
        LIMIT ?, ?
SQL;

        $offset = $page === 1
            ? 0
            : ($page - 1) * $count;

        try {
            $statement = $this->query($sql, [$offset, $count]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return NoticiaFactory::fromMysqlRows($rows);
    }
}
