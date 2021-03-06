<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Alumno;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class JudokaModel.
 * Judoka model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class JudokaModel extends BaseModel
{
    /**
     * Inserts a judoka in the database
     * @param string $name
     * @param string $lastName1
     * @param string $lastName2
     * @param int $sex
     * @param int $userId
     * @param int $fanjydaId
     * @param string $dni
     * @param string $birthDate
     * @param int $phone
     * @param string $email
     * @param string $illness
     * @param int $parentId
     * @param int $beltId
     * @param int $addressId
     * @param int $classid
     * @return bool
     * @throws QueryException
     */
    public function add(
        string $name,
        string $lastName1,
        ?string $lastName2,
        int $sex,
        ?int $userId,
        ?int $fanjydaId,
        ?string $dni,
        string $birthDate,
        int $phone,
        ?string $email,
        ?string $illness,
        ?int $parentId,
        int $beltId,
        ?int $addressId,
        int $classid
    ): bool {
        $sql = <<<SQL
        INSERT INTO pupil(
            name,
            surname,
            second_surname,
            gender,
            user_id,
            fanjyda_id,
            DNI,
            birth_date,
            phone,
            email,
            extra_info,
            guardian_id,
            belt_id,
            address_id,
            class_id
        )
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);
SQL;
        $binds = [
            $name,
            $lastName1,
            $lastName2,
            $sex,
            $userId,
            $fanjydaId,
            $dni,
            $birthDate,
            $phone,
            $email,
            $illness,
            $parentId,
            $beltId,
            $addressId,
            $classid
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        return true;
    }

    public function addJudokaFromRegister(
        string $name,
        string $lastName1,
        string $lastName2,
        int $phone,
        ?string $email
    ): bool {
        $sql = <<<SQL
        INSERT INTO pupil(
            name,
            surname,
            second_surname,
            phone,
            email
        )
        VALUES (?, ?, ?, ?, ?);
SQL;
        $binds = [
            $name,
            $lastName1,
            $lastName2,
            $phone,
            $email
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }
        return true;
    }

    /**
     * Modifies a judoka from the database
     * @param string $name
     * @param string $lastName1
     * @param string $lastName2
     * @param int $sex
     * @param int $userId
     * @param int $fanjydaId
     * @param string $dni
     * @param string $birthDate
     * @param int $phone
     * @param string $email
     * @param string $illness
     * @param int $parentId
     * @param int $beltId
     * @param int $addressId
     * @param int $classid
     * @param int $judokaId
     * @return bool
     * @throws QueryException
     */
    public function modify(
        string $name,
        string $lastName1,
        ?string $lastName2,
        int $sex,
        ?int $userId,
        ?int $fanjydaId,
        ?string $dni,
        string $birthDate,
        ?int $phone,
        ?string $email,
        ?string $illness,
        ?int $parentId,
        int $beltId,
        ?int $addressId,
        ?int $classid,
        ?int $judokaId
    ): bool
    {
        $sql = <<<SQL
        UPDATE pupil SET
            name = ?,
            surname = ?,
            second_surname = ?,
            gender = ?,
            fanjyda_id = ?,
            DNI = ?,
            birth_date = ?,
            phone = ?,
            email = ?,
            extra_info = ?,
            guardian_id = ?,
            belt_id = ?,
            address_id = ?,
            class_id = ?,
             user_id = ?
        WHERE id = ?
SQL;
        $binds = [
            $name,
            $lastName1,
            $lastName2,
            $sex,
            $fanjydaId,
            $dni,
            $birthDate,
            $phone,
            $email,
            $illness,
            $parentId,
            $beltId,
            $addressId,
            $classid,
            $userId,
            $judokaId,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }


    public function deleteFromClass(
        int $judokaId
    ): bool
    {
        $sql = <<<SQL
        UPDATE pupil SET
            class_id = null      
        WHERE id = ?
SQL;
        $binds = [
            $judokaId,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }


    /**
     * Links a judoka with his user account
     * @param int|null $userId
     * @param int $judokaId
     * @return bool
     * @throws QueryException
     */
    public function linkWithUser(
        ?int $userId,
        int $judokaId
    ): bool
    {
        $sql = <<<SQL
        UPDATE pupil SET
            user_id = ?      
        WHERE id = ?
SQL;
        $binds = [
            $userId,
            $judokaId
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Deteles a judoka from the database
     * @param int $codJudoka
     * @return bool
     * @throws QueryException
     */
    public function delete(
        int $codJudoka
    ): bool
    {
        $sql = <<<SQL
        DELETE FROM pupil WHERE `id` = ?;
SQL;
        $binds = [
            $codJudoka,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Get all judokas from database
     * @return array
     */
    public function getAllJudokas(): array
    {
        $sql = <<<SQL
        SELECT p.name AS name,
            p.surname AS lastName1,
            p.second_surname AS lastName2,
            p.gender AS sex,
            p.id as judokaId,
            p.user_id as userId,
            p.fanjyda_id as fanjydaId,
            p.DNI AS dni,
            p.birth_date as birthDate,
            p.phone as phone,
            p.email as email,
            p.extra_info as illness,
            p.guardian_id as parentId,
            p.belt_id as beltId,
            p.address_id as addressId,
            p.class_id as classId
        FROM pupil p
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
     * Gets one judoka by user id
     * @param $userId
     * @return array
     */
    public function getOneJudokaByUserId($userId): array
    {
        $sql = <<<SQL
        SELECT p.name AS name,
            p.surname AS lastName1,
            p.second_surname AS lastName2,
            p.gender AS sex,
            p.id as judokaId,
            p.user_id as userId,
            p.fanjyda_id as fanjydaId,
            p.DNI AS dni,
            p.birth_date as birthDate,
            p.phone as phone,
            p.email as email,
            p.extra_info as illness,
            p.guardian_id as parentId,
            p.belt_id as beltId,
            p.address_id as addressId,
            p.class_id as classId
        FROM pupil p
        WHERE p.user_id = ?
SQL;
        $binds = [
            $userId,
        ];

        try {
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if($rows == false){
            $rows[0] = [];
        }
        return $rows[0];
    }

    /**
     * Gets judokas by their class ID
     * @param $classId
     * @return array
     */
    public function getJudokasByClassId($classId): array
    {
        $sql = <<<SQL
        SELECT p.name AS name,
            p.surname AS lastName1,
            p.second_surname AS lastName2,
            p.gender AS sex,
            p.id as judokaId,
            p.user_id as userId,
            p.fanjyda_id as fanjydaId,
            p.DNI AS dni,
            p.birth_date as birthDate,
            p.phone as phone,
            p.email as email,
            p.extra_info as illness,
            p.guardian_id as parentId,
            p.belt_id as beltId,
            p.address_id as addressId,
            p.class_id as classId
        FROM pupil p
        WHERE p.class_id = ?
SQL;
        $binds = [
            $classId,
        ];

        try {
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if($rows == false){
            $rows= [];
        }
        return $rows;
    }

    /**
     * Finds a judoka by some basics data
     * @param $name
     * @param $surname
     * @param $email
     * @return array
     */
    public function findJudoka($name,$surname,$email): array
    {
        $sql = <<<SQL
        SELECT p.name AS name,
            p.surname AS lastName1,
            p.second_surname AS lastName2,
            p.gender AS sex,
            p.id as judokaId,
            p.user_id as userId,
            p.fanjyda_id as fanjydaId,
            p.DNI AS dni,
            p.birth_date as birthDate,
            p.phone as phone,
            p.email as email,
            p.extra_info as illness,
            p.guardian_id as parentId,
            p.belt_id as beltId,
            p.address_id as addressId,
            p.class_id as classId,
            p.id as id
        FROM pupil p
        WHERE p.name = ?  
        AND p.surname = ?
        AND p.email = ?
SQL;
        $binds = [
            $name,
            $surname,
            $email
        ];

        try {
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if($rows == false){
            $rows[0] = [];
        }
        return $rows[0];
    }

    /**
     * Gets one judoka by id
     * @param $judokaId
     * @return array
     */
    public function getOneJudoka($judokaId): array
    {
        $sql = <<<SQL
        SELECT p.name AS name,
            p.surname AS lastName1,
            p.second_surname AS lastName2,
            p.gender AS sex,
            p.id as judokaId,
            p.user_id as userId,
            p.fanjyda_id as fanjydaId,
            p.DNI AS dni,
            p.birth_date as birthDate,
            p.phone as phone,
            p.email as email,
            p.extra_info as illness,
            p.guardian_id as parentId,
            p.belt_id as beltId,
            p.address_id as addressId,
            p.class_id as classId
        FROM pupil p
        WHERE p.id = ?
SQL;
        $binds = [
            $judokaId,
        ];

        try {
            $statement = $this->query($sql, $binds);
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }

        return $rows;
    }

    /**
     * Update a judoka.
     * @param Alumno $judoka
     * @return Alumno
     * @throws QueryException
     */
    public function update(Alumno $judoka): Alumno
    {
        $sql = <<<SQL
        UPDATE pupil SET
            name = ?,
            surname = ?,
            second_surname = ?,
            gender = ?,
            fanjyda_id = ?,
            DNI = ?,
            birth_date = ?,
            phone = ?,
            email = ?,
            extra_info = ?,
            guardian_id = ?,
            belt_id = ?,
            address_id = ?,
            class_id = ?      
        WHERE id = ?
SQL;
        $binds = [
            $judoka->name(),
            $judoka->lastname(),
            $judoka->secondLastname(),
            $judoka->gender(),
            $judoka->fanjydaId(),
            $judoka->dni(),
            $judoka->birthDate()->format(ConnectionHelper::MYSQL_DATE_FORMAT),
            $judoka->phone(),
            $judoka->email(),
            $judoka->illness(),
            $judoka->parentId(),
            $judoka->beltId(),
            $judoka->addressId(),
            $judoka->classId(),
            $judoka->id()
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return $judoka;
    }

    /**
     * Adds a judoka to a class
     * @param int $judokaId
     * @param int $classId
     * @return bool
     * @throws QueryException
     */
    public function addJudokaClass(int $judokaId, int $classId): bool
    {
        $sql = <<<SQL
        UPDATE pupil SET
            class_id = ?      
        WHERE id = ?
SQL;
        $binds = [
           $classId,
            $judokaId
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * Deletes a judoka from a class
     * @param int $judokaId
     * @param int $classId
     * @return bool
     * @throws QueryException
     */
    public function deleteJudokaClass(int $judokaId, int $classId): bool
    {
        $sql = <<<SQL
        UPDATE pupil SET
            class_id = null      
        WHERE id = ?
        AND class_id = ?
SQL;
        $binds = [
            $judokaId,
            $classId,

        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }


}
