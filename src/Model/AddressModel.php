<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use Exception;
use PDO;
use WebFeletesDevelopers\Kazoku\Model\Entity\Direccion;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\AddressFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class AddressModel
 * News model.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class AddressModel extends BaseModel
{
    /**
     * Inserts an address in the database
     * @param int $zip
     * @param string $locality
     * @param string $province
     * @param string $address
     * @return bool
     * @throws QueryException
     */
    public function add(int $zip, string $locality, string $province, string $address): Direccion
    {
        $sql = <<<SQL
        INSERT INTO address(zip_code, locality, province, address)
        VALUES (?, ?, ?, ?);
SQL;
        $binds = [
            $zip,
            $locality,
            $province,
            $address
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return new Direccion(
            $this->db->lastInsertId(),
            $zip,
            $locality,
            $province,
            $address
        );
    }

    /**
     * Deletes an adress from the Database
     * @param int $id
     * @return bool
     * @throws QueryException
     */
    public function delete(
        int $id
    ): bool {
        $sql = <<<SQL
        DELETE FROM address WHERE `id` = ?;
SQL;
        $binds = [
            $id,
        ];

        $statement = $this->query($sql, $binds);
        if ($statement === false) {
            throw QueryException::fromFailedQuery($sql, $binds);
        }

        return true;
    }

    /**
     * get an address by id
     * @param $id
     * @return array
     */
    public function getAddress($id): array
    {
        $sql = <<<SQL
         SELECT a.id AS id,
               a.zip_code AS zip,
               a.locality AS locality,
               a.province AS province,
               a.address AS address
        FROM address a
        WHERE a.id = ?
SQL;
        try {
            $statement = $this->query($sql, [$id]);
            $rows = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return $rows;
    }

    public function getAll(): array
    {
        $sql = <<<SQL
         SELECT a.id AS id,
               a.zip_code AS zip,
               a.locality AS locality,
               a.province AS province,
               a.address AS address
        FROM address a
SQL;
        try {
            $statement = $this->query($sql);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }
        return AddressFactory::fromMysqlRows($rows);
    }

    public function getByNaturalSearch(string $input): array
    {
        $sql = <<<SQL
         SELECT a.id AS id,
               a.zip_code AS zip,
               a.locality AS locality,
               a.province AS province,
               a.address AS address
        FROM address a
        WHERE MATCH(a.address) AGAINST (? IN NATURAL LANGUAGE MODE)
SQL;
        try {
            $statement = $this->query($sql, [$input]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $rows = [];
        }

        return AddressFactory::fromMysqlRows($rows);
    }
}
