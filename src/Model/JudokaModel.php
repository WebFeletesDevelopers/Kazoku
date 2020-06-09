<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use DateTime;
use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\JudokaFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\Judoka;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class NoticiaModel
 * News model.
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
     * @param DateTime $birthDate
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
    ): bool
    {
        $sql = <<<SQL
        INSERT INTO alumno(nombre, apellido1, apellido2, sexo, codusu, idfanjyda, dni, fechanacimiento, telefono, email, enfermedad, codtut, codcinturon, coddireccion, codclase)
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
        UPDATE alumno 
        SET nombre = ?, apellido1 = ?, apellido2 = ?, sexo = ?, codusu = ?, idfanjyda = ?, dni = ?, fechanacimiento = ?, telefono = ?, email = ?, enfermedad = ?, codtut = ?, codcinturon = ?, coddireccion = ?, codclase = ?
        WHERE CodAlumno = ?
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
            $classid,
            $judokaId,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw InsertException::fromFailedInsert($sql, $binds);
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
        DELETE FROM alumno WHERE `CodAlumno` = ?;
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
        SELECT a.Nombre AS name,
                a.Apellido1 AS lastName1,
                a.Apellido2 AS lastName2,
                a.Sexo AS sex,
                a.CodAlumno as judokaId,
                a.CodUsu as userId,
                a.IdFanjyda as fanjydaId,
                a.dni AS dni,
                a.FechaNacimiento as birthDate,
                a.Telefono as phone,
                a.Email as email,
                a.Enfermedad as illness,
                a.CodTut as parentId,
                a.CodCinturon as beltId,
                a.CodDireccion as addressId,
                a.CodClase as classId
        FROM alumno a
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
     * Gets one judoka
     * @param $judokaId
     * @return array
     */
    public function getOneJudoka($judokaId): array
    {
        $sql = <<<SQL
        SELECT a.Nombre AS name,
                a.Apellido1 AS lastName1,
                a.Apellido2 AS lastName2,
                a.Sexo AS sex,
                a.CodAlumno as judokaId,
                a.CodUsu as userId,
                a.IdFanjyda as fanjydaId,
                a.dni AS dni,
                a.FechaNacimiento as birthDate,
                a.Telefono as phone,
                a.Email as email,
                a.Enfermedad as illness,
                a.CodTut as parentId,
                a.CodCinturon as beltId,
                a.CodDireccion as addressId,
                a.CodClase as classId
        FROM alumno a
        WHERE a.CodAlumno = ?
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
