<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Clase;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\ClaseFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class ClaseModel
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class ClaseModel extends BaseModel
{
    /**
     * @param string $schedule
     * @param string $trainer
     * @param int $minAge
     * @param int $maxAge
     * @param string $name
     * @param int $centerCode
     * @param int $days
     * @return bool
     * @throws QueryException
     */
    public function add(
        string $schedule,
        string $trainer,
        int $minAge,
        int $maxAge,
        string $name,
        int $centerCode,
        int $days
    ): bool {
        $sql = <<<SQL
        INSERT INTO class(schedule, trainer, minimum_age, maximum_age, name, center_id, days)
        VALUES (?, ?, ?, ?, ?, ?, ?);
SQL;
        $binds = [
            $schedule,
            $trainer,
            $minAge,
            $maxAge,
            $name,
            $centerCode,
            $days
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Modifies a class of the DB
     * @param int $classId
     * @param string $schedule
     * @param string $trainer
     * @param int $minAge
     * @param int $maxAge
     * @param string $name
     * @param int $centerCode
     * @param int $days
     * @return bool
     * @throws QueryException
     */
    public function modify(
        string $schedule,
        string $trainer,
        int $minAge,
        int $maxAge,
        string $name,
        int $centerCode,
        int $days,
        int $classId
    ): bool {
        $sql = <<<SQL
        UPDATE class c
        SET c.schedule = ?, c.trainer = ?, c.minimum_age = ?, c.maximum_age = ?, c.name = ?, c.center_id = ?, c.days = ?
        WHERE c.id = ?
SQL;
        $binds = [
            $schedule,
            $trainer,
            $minAge,
            $maxAge,
            $name,
            $centerCode,
            $days,
            $classId
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }


    /**
     * Deletes a class from the Database
     * @param int $CodClass
     * @return bool
     * @throws QueryException
     */
    public function delete(
        int $CodClass
    ): bool {
        $sql = <<<SQL
        DELETE FROM class WHERE `id` = ?;
SQL;
        $binds = [
            $CodClass,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        return true;
    }

    /**
     * Get classes
     * @return Clase[]
     */
    public function getClases(): array {
        $rows = $this->getClassRows();
        return ClaseFactory::fromMysqlRows($rows);
    }


    /**
     * Query builder for classes select
     * @return array
     */
    private function getClassRows(): array
    {
        $sql = <<<SQL
        SELECT c.id AS id,
               c.schedule AS schedule,
               c.trainer AS trainer,
               c.minimum_age AS minAge,
               c.maximum_age AS maxAge,
               c.name AS name,
               c.center_id AS centerId,
               c.days AS days
        FROM class c
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
     * Get all classes with more data
     * @return array
     */
    public function getClasesAllData(): array
    {
        $sql = <<<SQL
        SELECT cl.id AS id,
               cl.schedule AS schedule,
               cl.trainer AS trainer,
               cl.minimum_age AS minAge,
               cl.maximum_age AS maxAge,
               cl.name AS name,
               cl.center_id AS centerId,
               cl.days AS days,
                c.name AS centerName,
                c.address AS centerSt,
                c.phone as centerTel,
        (
        SELECT count(*) as judokas from pupil p where p.class_id = cl.id
        )
        
        FROM class cl  
            join center c on cl.center_id = c.id 
        ORDER BY cl.id
SQL;

        try {
            $statement = $this->query($sql);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            $rows = [];
        }


        return $rows;
    }
    public function getClass($classId): array
    {
        $sql = <<<SQL
        SELECT cl.id AS id,
               cl.schedule AS schedule,
               cl.trainer AS trainer,
               cl.minimum_age AS minAge,
               cl.maximum_age AS maxAge,
               cl.name AS name,
               cl.center_id AS centerId,
               cl.days AS days,
                c.name AS centerName,
                c.address AS centerSt,
                c.phone as centerTel,
        (
        SELECT count(*) as judokas from pupil p where p.class_id = cl.id
        )
        
        FROM class cl  
            join center c on cl.center_id = c.id 
        WHERE cl.id = ?
        
  SQL;

        try {
            $statement = $this->query($sql, $classId);
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }

        return $rows;
    }
}
