<?php

namespace WebFeletesDevelopers\Kazoku\Model\Exception;

use Exception;

class InvalidUserIdException extends Exception
{
    /**
     * @param int $id
     * @return self
     */
    public static function fromInvalidId(int $id): self
    {
        $message = _('The user with ID %d does not exist.');
        return new self(sprintf($message, $id));
    }
}
