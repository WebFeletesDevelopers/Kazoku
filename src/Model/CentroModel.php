<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Centro;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\CentroFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class CentroModel
 * Center model
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class CentroModel extends BaseModel
{
    /**
     * @param string $name
     * @param string $direction
     * @param int $zip
     * @param int $phone
     * @return bool
     * @throws QueryException
     */
    public function add(
        string $name,
        string $direction,
        int $zip,
        int $phone
    ): bool {
        $sql = <<<SQL
        INSERT INTO center(name, address, zip_code, phone)
        VALUES (?, ?, ?, ?);
SQL;
        $binds = [
            $name,
            $direction,
            $zip,
            $phone
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Modifies a center from database
     * @param string $name
     * @param string $direction
     * @param int $zip
     * @param int $phone
     * @param int $centerId
     * @return bool
     * @throws QueryException
     */
    public function modify(
        string $name,
        string $direction,
        int $zip,
        int $phone,
        int $centerId
    ): bool {
        $sql = <<<SQL
        UPDATE center c
        SET c.name = ?, c.address = ?, c.zip_code = ?, c.phone = ?
        WHERE c.id = ?
SQL;
        $binds = [
            $name,
            $direction,
            $zip,
            $phone,
            $centerId
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Deletes a center from the Database
     * @param int $CodCentro
     * @return bool
     * @throws QueryException
     */
    public function delete(
        int $CodCentro
    ): bool {
        $sql = <<<SQL
        DELETE FROM center WHERE `id` = ?;
SQL;
        $binds = [
            $CodCentro,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Get centers
     * @return Centro[]
     */
    public function getCentros(): array {
        $rows = $this->getCenterRows();
        return CentroFactory::fromMysqlRows($rows);
    }

    /**
     * @param int $centerId
     * @return Centro[]
     */
    public function getCentro(
        int $centerId
    ): array {
        $sql = <<<SQL
        SELECT c.id AS id,
               c.name AS name,
               c.address AS direction,
               c.zip_code AS zip,
               c.phone AS phone
        FROM center c
        WHERE c.id = ?;
SQL;
        $binds = [
            $centerId,
        ];
        try {
            $statement = $this->query($sql, $binds);
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        }
      catch (Exception $e) {
            $rows = [];
        }
        return $rows;

    }

    /**
     * Query builder for center select
     * @return Centro[]
     */
    private function getCenterRows(): array
    {
        $sql = <<<SQL
        SELECT c.id AS id,
               c.name AS name,
               c.address AS direction,
               c.zip_code AS zip,
               c.phone AS phone
        FROM center c
        ORDER BY c.id
SQL;

        try {
            $statement = $this->query($sql);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return $rows;
    }

    /**
     * Get all centers with more data
     * @return Centro[]
     */
    public function getCenterAllData(): array
    {
        $sql = <<<SQL
        SELECT c.id AS id,
               c.name AS name,
               c.address AS direction,
               c.zip_code AS zip,
               c.phone AS phone,
        (
        SELECT count(*) as classes from class cl where c.id = cl.center_id
        )
        FROM center c 
        ORDER BY c.id
SQL;

        try {
            $statement = $this->query($sql);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return $rows;
    }

}
