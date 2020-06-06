<?php

namespace WebFeletesDevelopers\Kazoku\Utils;

use Exception;

/**
 * Class Utils
 * Functions that don't fit anywhere else.
 * @package WebFeletesDevelopers\Kazoku\Utils
 */
class Utils
{
    /**
     * Generate a random string.
     * @param int $length
     * @return string
     */
    public static function generateRandomString(int $length): string
    {
        $length /= 2;
        try {
            return bin2hex(random_bytes($length));
        } catch (Exception $e) {
            return hash('sha3-256', mt_rand());
        }
    }
}
