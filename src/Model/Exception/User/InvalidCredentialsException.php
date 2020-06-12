<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception\User;

use Exception;

class InvalidCredentialsException extends Exception
{
    /**
     * Exception for invalid credentials.
     * @return static
     */
    public static function fromInvalidCredentials(): self
    {
        $message = _('Credenciales invalidas');
        return new self($message);
    }
}
