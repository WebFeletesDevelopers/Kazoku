<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use DateTime;
use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\ClaseFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\DeleteException;
use WebFeletesDevelopers\Kazoku\Model\Exception\InsertException;


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
     * @throws InsertException
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
        INSERT INTO clase(Horario, Profesor, EdadMin, EdadMax, Nombre, CodCentro, Dias)
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
            throw InsertException::fromFailedInsert($sql, $binds);
        }

        return true;
    }

    /**
     * Deletes a class from the Database
     * @param int $CodClass
     * @return bool
     * @throws DeleteException
     */
    public function delete(
        int $CodClass
    ): bool {
        $sql = <<<SQL
        DELETE FROM clase WHERE `CodClase` = ?;
SQL;
        $binds = [
            $CodClass,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw DeleteException::fromFailedDelete($sql, $binds);
        }

        return true;
    }

    /**
     * Get classes
     * @param int $count
     * @param int $page
     * @return Clases[]
     */
    public function getClases(int $count = 5, int $page = 1): array {
        $rows = $this->getClassRows($count, $page);
        return ClaseFactory::fromMysqlRows($rows);
    }


    /**
     * Query builder for classes select
     * @param int $count
     * @param int $page
     * @param bool $onlyPublic
     * @return array
     */
    private function getClassRows(int $count, int $page): array
    {
        $preSql = <<<SQL
        SELECT n.CodClase AS id,
               n.Horario AS schedule,
               n.Profesor AS trainer,
               n.EdadMin AS minAge,
               n.EdadMax AS maxAge,
               n.Nombre AS name,
               n.CodCentro AS centerId,
               n.Dias AS days
        FROM clase n
        %s
        ORDER BY n.CodClase
        
SQL;

        $sql = sprintf($preSql, true);

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
