<?php

namespace WebFeletesDevelopers\Kazoku\Action\Exception;

use Exception;

/**
 * Class InvalidParametersException
 * @package WebFeletesDevelopers\Kazoku\Action\Exception
 */
class InvalidParametersException extends Exception
{
    /**
     * Exception for invalid parameters.
     * @param string $parameter
     * @return static
     */
    public static function fromInvalidParameter(string $parameter): self
    {
        $message = _('The parameter %s is invalid!');
        return new self(sprintf($message, $parameter));
    }
}
