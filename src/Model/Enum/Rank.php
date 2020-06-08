<?php

namespace WebFeletesDevelopers\Kazoku\Model\Enum;

/**
 * Class Rank
 * Enum for ranks
 * @package WebFeletesDevelopers\Kazoku\Model\Enum
 */
class Rank
{
    private const ADMIN = 0;
    private const TRAINER = 1;
    private const PARENT = 2;
    private const PUPIL = 3;
    private const UNREGISTERED = 4;

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
