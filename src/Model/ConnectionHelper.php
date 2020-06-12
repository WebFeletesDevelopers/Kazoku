<?php

namespace WebFeletesDevelopers\Kazoku\Model;

use PDO;

/**
 * Class ConnectionHelper
 * Helper to get a PDO instance.
 * @package WebFeletesDevelopers\Kazoku\Model
 */
class ConnectionHelper
{
    private const MYSQL_DSN = 'mysql:host=%s;dbname=%s;charset=utf8';
    public const MYSQL_DATE_FORMAT = 'Y-m-d';

    /**
     * Get a new PDO instance, with data from environment variables.
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        return new PDO(
            sprintf(self::MYSQL_DSN, 'db', getenv('KAZOKU_DATABASE_DATABASE')),
            getenv('KAZOKU_DATABASE_USER'),
            getenv('KAZOKU_DATABASE_PASSWORD')
        );
    }
}
