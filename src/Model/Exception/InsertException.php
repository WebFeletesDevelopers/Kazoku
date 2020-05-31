<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception;

use Exception;

/**
 * Class InsertException
 * Used for error while inserting in a model.
 * @package WebFeletesDevelopers\Kazoku\Model\Exception
 */
class InsertException extends Exception
{
    private const INSERT_ERROR_MESSAGE = 'The query %s with values %s failed';

    /**
     * Return an insert exception.
     * @param string $query
     * @param array $binds
     * @return self
     */
    public static function fromFailedInsert(string $query, array $binds): self
    {
        return new self(sprintf(
            self::INSERT_ERROR_MESSAGE,
            $query,
            implode(', ', $binds)
        ));
    }
}
