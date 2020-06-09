<?php

namespace WebFeletesDevelopers\Kazoku\Model\Enum;

/**
 * Class Rank
 * Enum for ranks
 * @package WebFeletesDevelopers\Kazoku\Model\Enum
 */
class Rank
{
    public const ADMIN = 0;
    public const TRAINER = 1;
    public const PARENT = 2;
    public const PUPIL = 3;
    public const UNREGISTERED = 4;

    private const RANK_TO_NUMBER = [
        'admin' => self::ADMIN,
        'trainer' => self::TRAINER,
        'parent' => self::PARENT,
        'pupil' => self::PUPIL,
        'unregistered' => self::UNREGISTERED,
    ];

    public const VALID_RANKS_FOR_REGISTER = [
        self::TRAINER,
        self::PARENT,
        self::PUPIL
    ];

    public const TRAINER_RANKS = [
        self::TRAINER,
        self::ADMIN
    ];
}
