<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use PDO;
use PDOStatement;

/**
 * Class BaseModel
 * Base class for PDO models with useful functions.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
abstract class BaseModel
{
    private PDO $db;

    /**
     * BaseModel constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    /**
     * Try to prepare an statement and bind parameters.
     * @param string $sql
     * @param array $binds
     * @return PDOStatement
     */
    protected function query(string $sql, array $binds = []): PDOStatement
    {
        $statement = $this->db->prepare($sql);

        if (! empty($binds)) {
            $statement = $this->bindParams($statement, $binds);
        }

        $statement->execute();
        return $statement;
    }

    /**
     * @param PDOStatement $statement
     * @param array $binds
     * @return PDOStatement
     */
    private function bindParams(PDOStatement $statement, array $binds): PDOStatement
    {
        foreach ($binds as $key => $value) {
            $type = $this->getType($value);
            $statement->bindValue($key + 1, $value, $type);
        }

        return $statement;
    }

    private function getType($value): int
    {
        $type = gettype($value);

        if ($type === 'null' || $value === null) {
            $pdoType = PDO::PARAM_NULL;
        } elseif ($type === 'boolean') {
            $pdoType = PDO::PARAM_BOOL;
        } elseif ($type === 'integer' && $value === (int)$value) {
            $pdoType = PDO::PARAM_INT;
        }

        return $pdoType ?? PDO::PARAM_STR;
    }
}
