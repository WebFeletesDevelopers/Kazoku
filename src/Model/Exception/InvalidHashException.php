<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception;

use Exception;

/**
 * Class InvalidHashException
 * Used when the user tries to do some trickery with a hash.
 * @package WebFeletesDevelopers\Kazoku\Model\Exception
 */
class InvalidHashException extends Exception
{
    private const INVALID_HASH_MESSAGE = 'The hash is invalid';

    /**
     * @return static
     */
    public static function fromInvalidHash():self
    {
        return new self(self::INVALID_HASH_MESSAGE);
    }
}
