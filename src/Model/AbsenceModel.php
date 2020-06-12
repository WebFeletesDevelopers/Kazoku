<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Absence;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\AbsenceFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class AbsenceModel
 * Absence model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class AbsenceModel extends BaseModel
{

    /**
     * insert onto bd
     * @param Absence $absence
     * @return bool
     * @throws QueryException
     */
    public function new(Absence $absence): bool
    {
        $sql = <<<SQL
        INSERT INTO absence(userId,classId,date)
        VALUES (?, ?, ?)
SQL;
        $binds = [
            $absence->getUserId(),
            $absence->getClassId(),
            $absence->getDate(),
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);

        }
        return true;
    }

    /**
     * Delete from bd
     * @param int $id
     * @return bool
     * @throws QueryException
     */
    public function deleteById(int $id): bool
    {
        $sql = <<<SQL
        DELETE FROM absence
        WHERE id = ?
SQL;

        $binds = [$id];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Deletes an absence by judoka and date
     * @param int $judokaId
     * @param $date
     * @return bool
     * @throws QueryException
     */
    public function deleteByParams(int $judokaId, $date): bool
    {
        $sql = <<<SQL
        DELETE FROM absence
        WHERE userId = ?
        AND date = ?
SQL;

        $binds = [$judokaId,$date];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    public function deletebyJudokaId(int $judokaId): bool
    {
        $sql = <<<SQL
        DELETE FROM absence
        WHERE userId = ?
SQL;
        $binds = [$judokaId];
        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    public function getAllFromPupil(int $judokaId): array {
        $sql = <<<SQL
               SELECT 
                a.id as id,
                a.userId as judokaId,
                a.classId as classId,
                a.date as date
        FROM absence a
        WHERE userId = ?
SQL;
        $binds = [$judokaId];
        try {
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if(! $statement || $statement->rowCount() === 0){
            $rows = [];
        }
        return $rows;
    }

    /**
     * get all from a class
     * @param int $classId
     * @return array
     */
    public function getAllFromClass(int $classId): array {
        $sql = <<<SQL
        SELECT 
                a.id as id,
                a.userId as judokaId,
                a.classId as classId,
                a.date as date
        FROM absence a
        WHERE classId = ?
SQL;
        $binds = [$classId];
        try{
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if($rows == false){
            $rows[] = [];
        }
        return $rows;
    }



    public function searchForExisting(int $userId,$date): array {
        $sql = <<<SQL
        SELECT 
                a.id as id,
                a.userId as judokaId,
                a.classId as classId,
                a.date as date
        FROM absence a
        WHERE userId = ?
        AND date = ?
SQL;
        $binds = [$userId,$date];
        try{
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return $rows;
    }


    /**
     * Get all absences
     * @return array
     */
    public function getAll(): array {
        $sql = <<<SQL
                SELECT 
                a.id as id,
                a.userId as judokaId,
                a.classId as classId,
                a.date as date
        FROM absence a
SQL;
        try{
            $statement = $this->query($sql);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if($rows == false){
            $rows[] = [];
        }
        return AbsenceFactory::fromMysqlRows($rows);
    }

}
