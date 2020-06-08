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

    /**
     * Delete the given class from the database
     * @param int $classCode
     * @return bool
     */
    public function deleteClass(
        int $classCode
    ): bool {
            return $this->model->delete($classCode);
    }

    /**
     * @param string $schedule
     * @param string $trainer
     * @param int $minAge
     * @param int $maxAge
     * @param string $name
     * @param int $centerCode
     * @param int $days
     * @param int $classId
     * @return bool
     */
    public function modify(
        string $schedule,
        string $trainer,
        int $minAge,
        int $maxAge,
        string $name,
        int $centerCode,
        int $days,
        int $classId
    ): bool {
        return $this->model->modify($schedule, $trainer, $minAge, $maxAge, $name, $centerCode, $days,$classId);
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

    public function getClass($classId): array
    {
        return $this->model->getClass($classId);
    }


}
