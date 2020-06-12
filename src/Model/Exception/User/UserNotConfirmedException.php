<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception\User;

use Exception;

/**
 * Class UserNotConfirmedException
 * Exception for not confirmed users trying to log in.
 * @package WebFeletesDevelopers\Kazoku\Model\Exception\User
 */
class UserNotConfirmedException extends Exception
{
    /**
     * @param string $userName
     * @return self
     */
    public static function fromNotConfirmedUser(string $userName): self
    {
        $message = _('El usuario %s no esta confirmado');
        return new self(sprintf($message, $userName));
    }
}
