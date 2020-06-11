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
     * @throws \WebFeletesDevelopers\Kazoku\Model\Exception\QueryException
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
     * @throws \WebFeletesDevelopers\Kazoku\Model\Exception\QueryException
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
     * @throws \WebFeletesDevelopers\Kazoku\Model\Exception\QueryException
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

    public function getClass($classId): ?array
    {
        return $this->model->getClass($classId);
    }

    public function getCurrentClassId(): int{
        $class = null;
        $classes = $this->model->getClasesAllData();
        $res = 0;
        foreach($class as $classes) {
            if ($this->isClassToday($class['days'])) {
                if ($this->isOnTime($class['schedule'])) {
                    $res = $class['id'];
                } else {
                    $res =  0;
                }
            } else {
                $res = 0;
            }
        }
        return $res;
    }

    private function isOnTime($schedule): bool{
        $hours = explode(' - ',$schedule);
        if ( strtotime( date('H:i')) - strtotime($hours[0]) >= 0){
            if( strtotime( date('H:i')) - strtotime($hours[1]) >= 0){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }

    private function isClassToday($days):bool{
        $daysAr = array_reverse(str_split(sprintf("%05d", decbin($days))));
        $today = date('N')-1;
        if ($daysAr[$today] === 1){
            return true;
        }
        else{
            return false;
        }
    }

}
