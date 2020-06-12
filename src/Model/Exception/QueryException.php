<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception;

use Exception;

/**
 * Class QueryException
 * Used for error while querying in a model.
 * @package WebFeletesDevelopers\Kazoku\Model\Exception
 */
class QueryException extends Exception
{
    private const FAILED_QUERY_MESSAGE = 'The query %s with values %s failed';

    /**
     * Return an insert exception.
     * @param string $query
     * @param array $binds
     * @return self
     */
    public static function fromFailedQuery(string $query, array $binds): self
    {
        return new self(sprintf(
            self::FAILED_QUERY_MESSAGE,
            $query,
            implode(', ', $binds)
        ));
    }
}
