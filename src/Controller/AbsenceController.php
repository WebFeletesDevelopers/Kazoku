<?php

namespace WebFeletesDevelopers\Kazoku\Controller;


use WebFeletesDevelopers\Kazoku\Model\AbsenceModel;
use WebFeletesDevelopers\Kazoku\Model\Entity\Absence;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\ClaseFactory;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class AbsenceController
 * Controller used to manage Absences
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class AbsenceController
{
    private AbsenceModel $model;

    public function __construct(AbsenceModel $model)
    {
         $this->model = $model;
    }

    /**
     * Creates a new absence if it is not added yet
     * @param Absence $absence
     * @return bool
     */
    public function new(Absence $absence): bool {
        $inserted = $this->model->searchForExisting($absence->getUserId(),$absence->getDate());
        if($inserted == null){
            try {
                return $this->model->new($absence);
            } catch (QueryException $e) {
                return false;
            }
        }
        else{
            return $this->deleteByParams($absence->getUserId(),$absence->getDate());
        }

    }

    /**
     * delete by absence id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool {
        try {
            return $this->model->deleteById($id);
        } catch (QueryException $e) {
        }
    }

    /**
     * Delete by user id
     * @param int $judokaId
     * @return bool
     */
    public function deleteByJudokaId(int $judokaId): bool {
        try {
            return $this->model->deletebyJudokaId($judokaId);
        } catch (QueryException $e) {
        }
    }

    /**
     * Delete using parameters
     * @param int $judokaId
     * @param string $date
     * @return bool
     */
    public function deleteByParams(int $judokaId,string $date): bool{
        try {
            return $this->model->deleteByParams($judokaId,$date);
        } catch (QueryException $e) {
        }
    }

    /**
     * Get all absences from a judoka
     * @param int $judokaId
     * @return array
     */
    public function getAllFromJudoka(int $judokaId): array {
        return $this->model->getAllFromPupil($judokaId);
    }

    /**
     * Get all absences from a class
     * @param int $classId
     * @return array
     */
    public function getAllFromClass(int $classId): array {
        return $this->model->getAllFromClass($classId);
    }

    /**
     * Get all absences
     * @return array
     */
    public function getAll(): array {
        return $this->model->getAll();
    }






}
