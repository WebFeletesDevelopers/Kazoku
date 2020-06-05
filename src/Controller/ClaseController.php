<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Exception\DeleteException;
use WebFeletesDevelopers\Kazoku\Model\Exception\InsertException;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;

/**
 * Class classes controller
 * Class controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class ClaseController
{
    private ClaseModel $model;

    public function __construct(ClaseModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $schedule
     * @param string $trainer
     * @param int $minAge
     * @param int $maxAge
     * @param string $name
     * @param int $centerCode
     * @param int $days
     * @return bool
     * @throws InsertException
     */
    public function addClass(
        string $schedule,
        string $trainer,
        int $minAge,
        int $maxAge,
        string $name,
        int $centerCode,
        int $days
    ): bool {
        return $this->model->add($schedule, $trainer, $minAge, $maxAge, $name, $centerCode, $days);
    }
    public function deleteClass(
        int $classCode
    ): bool {
        try {
            return $this->model->delete($classCode);
        } catch (DeleteException $e) {
        }
    }

    /**
     * Function that brings the  classes
     * @param int $length
     * @return Clases[]
     */
    public function getClases(int $length = 5): array
    {
        return $this->model->getClases($length);
    }

}
