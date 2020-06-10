<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
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
        int $phone,
        ?string $email
    ): bool {
        $sql = <<<SQL
        INSERT INTO pupil(
            name,
            surname,
            phone,
            email
        )
        VALUES (?,?,?,?);
SQL;
        $binds = [
            $name,
            $lastName1,
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
        int $phone,
        string $email,
        ?string $illness,
        ?int $parentId,
        int $beltId,
        int $addressId,
        int $classid,
        int $judokaId
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
            class_id = ?      
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
            $judokaId,
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
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        if($rows == false){
            $rows = [];
        }
        return $rows;
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
            $statement = $this->query($sql,$binds);
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }

        return $rows;
    }
}
