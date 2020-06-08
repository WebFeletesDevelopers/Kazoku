<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\CentroFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\DeleteException;
use WebFeletesDevelopers\Kazoku\Model\Exception\InsertException;


class CentroModel extends BaseModel
{

    public function add(
        string $name,
        string $direction,
        int $zip,
        int $phone
    ): bool {
        $sql = <<<SQL
        INSERT INTO centro(Nombre, Direccion, CodPostal, Telefono)
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
            throw InsertException::fromFailedInsert($sql, $binds);
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
     */
    public function modify(
        string $name,
        string $direction,
        int $zip,
        int $phone,
        int $centerId
    ): bool {
        $sql = <<<SQL
        UPDATE centro c
        SET c.Nombre = ?, c.Direccion = ?, c.CodPostal = ?, c.Telefono = ?
        WHERE c.CodCentro = ?
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
            throw InsertException::fromFailedInsert($sql, $binds);
        }

        return true;
    }



    /**
     * Deletes a center from the Database
     * @param int $CodCentro
     * @return bool
     * @throws DeleteException
     */
    public function delete(
        int $CodCentro
    ): bool {
        $sql = <<<SQL
        DELETE FROM centro WHERE `CodCentro` = ?;
SQL;
        $binds = [
            $CodCentro,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw DeleteException::fromFailedDelete($sql, $binds);
        }

        return true;
    }




    /**
     * Get centers
     * @param int $count
     * @param int $page
     * @return Centros[]
     */
    public function getCentros(): array {
        $rows = $this->getCenterRows();
        return CentroFactory::fromMysqlRows($rows);
    }



    public function getCentro(
        int $centerId
    ): array {
        $sql = <<<SQL
        SELECT c.CodCentro AS id,
               c.Nombre AS name,
               c.Direccion AS direction,
               c.CodPostal AS zip,
               c.Telefono AS phone
        FROM centro c
        WHERE c.CodCentro = ?;
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
     * @return array
     */
    private function getCenterRows(): array
    {
        $preSql = <<<SQL
        SELECT c.CodCentro AS id,
               c.Nombre AS name,
               c.Direccion AS direction,
               c.CodPostal AS zip,
               c.Telefono AS phone
        FROM centro c
        ORDER BY c.CodCentro
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
     * Get all centers with more data
     * @return array
     */
    public function getCenterAllData(): array
    {
        $preSql = <<<SQL
        SELECT c.CodCentro AS id,
               c.Nombre AS name,
               c.Direccion AS direction,
               c.CodPostal AS zip,
               c.Telefono AS phone,
        (
        SELECT count(*) as classes from  clase cl where c.CodCentro = cl.CodCentro
        )
        FROM centro c 
        ORDER BY c.CodCentro
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

}
