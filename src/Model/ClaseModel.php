<?php

namespace WebFeletesDevelopers\Kazoku\Model;


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
}
