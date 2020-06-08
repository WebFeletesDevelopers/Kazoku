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
        UPDATE clase c
        SET c.Horario = ?, c.Profesor = ?, c.EdadMin = ?, c.EdadMax = ?, c.Nombre = ?, c.CodCentro = ?, c.Dias = ?
        WHERE c.CodClase = ?
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
        return true;
    }

    /**
     * Get classes
     * @param int $count
     * @param int $page
     * @return Clases[]
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
        ORDER BY n.CodClase
SQL;

        $sql = sprintf($preSql, true);
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
        $preSql = <<<SQL
        SELECT cl.CodClase AS id,
               cl.Horario AS schedule,
               cl.Profesor AS trainer,
               cl.EdadMin AS minAge,
               cl.EdadMax AS maxAge,
               cl.Nombre AS name,
               cl.CodCentro AS centerId,
               cl.Dias AS days,
                c.Nombre AS centerName,
                c.Direccion AS centerSt,
                c.Telefono as centerTel,
        (
        SELECT count(*) as judokas from  alumno a where a.CodClase = cl.CodClase
        )
        
        FROM clase cl  
            join centro c on cl.CodCentro = c.CodCentro 
        ORDER BY cl.CodClase
SQL;

        $sql = sprintf($preSql, true);
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
        $preSql = <<<SQL
        SELECT cl.CodClase AS id,
               cl.Horario AS schedule,
               cl.Profesor AS trainer,
               cl.EdadMin AS minAge,
               cl.EdadMax AS maxAge,
               cl.Nombre AS name,
               cl.CodCentro AS centerId,
               cl.Dias AS days,
                c.Nombre AS centerName,
                c.Direccion AS centerSt,
                c.Telefono as centerTel,
        (
        SELECT count(*) as judokas from  alumno a where a.CodClase = cl.CodClase
        )
        
        FROM clase cl  
            join centro c on cl.CodCentro = c.CodCentro 
        WHERE cl.CodClase = ?
        
  SQL;

        $sql = sprintf($preSql, true);
        try {
            $statement = $this->query($sql, $classId);
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }


        return $rows;
    }
}
