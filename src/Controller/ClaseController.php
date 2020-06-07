<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

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
            return $this->model->delete($classCode);
    }

    /**
     * Function that brings the  classes
     * @return Clases[]
     */
    public function getClases(): array
    {
        return $this->model->getClases();
    }

    /**
     * Get all classes with more data
     * @return array
     */
    public function getClasesAllData(): array
    {
        return $this->model->getClasesAllData();
    }


}
