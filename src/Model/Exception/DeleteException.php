<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception;

use Exception;

/**
 * Class DeleteException
 * Used for error while deleting in a model.
 * @package WebFeletesDevelopers\Kazoku\Model\Exception
 */
class DeleteException extends Exception
{
    private const DELETE_ERROR_MESSAGE = 'The query %s with values %s failed';

    /**
     * Return a delete exception.
     * @param string $query
     * @param array $binds
     * @return self
     */
    public static function fromFailedDelete(string $query, array $binds): self
    {
        return new self(sprintf(
            self::DELETE_ERROR_MESSAGE,
            $query,
            implode(', ', $binds)
        ));
    }
}
