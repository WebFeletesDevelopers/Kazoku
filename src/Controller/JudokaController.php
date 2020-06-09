<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;

/**
 * Class classes controller
 * Class controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class JudokaController
{
    private JudokaModel $model;

    public function __construct(JudokaModel $model)
    {
        $this->model = $model;
    }


    public function addJudoka(
        string $name,
        string $lastName1,
        string $lastName2,
        int $sex,
        int $userId,
        int $fanjydaId,
        string $dni,
        string $birthDate,
        int $phone,
        string $email,
        string $illness,
        int $parentId,
        int $beltId,
        int $addressId,
        int $classid
    ): bool {
        if($lastName2 == ''){
            $lastName2 = null;
        }
        if($userId == ''){
            $userId = null;
        }
        if($fanjydaId == ''){
            $fanjydaId = null;
        }
        if($dni == ''){
            $dni = null;
        }
        if($illness == ''){
            $illness = null;
        }
        if($parentId == ''){
            $parentId = null;
        }
        if($addressId == ''){
            $addressId = null;
        }
        try {
            return $this->model->add($name, $lastName1, $lastName2, $sex, $userId, $fanjydaId, $dni, $birthDate, $phone, $email, $illness, $parentId, $beltId, $addressId, $classid);
        } catch (QueryException $e) {
        }
    }

    public function deleteJudoka(
        int $judokaId
    ): bool {
        try {
            return $this->model->delete($judokaId);
        } catch (QueryException $e) {
        }
    }


    public function modifyJudoka(
        string $name,
        string $lastName1,
        ?string $lastName2,
        ?string $dni,
        string $email,
        ?string $illness,
        string $birthDate,
        int $sex,
        ?int $userId,
        ?int $parentId,
        int $addressId,
        int $beltId,
        int $classid,
        int $judokaId,
        int $phone,
        ?int $fanjydaId
    ): bool {
        if($lastName2 == ''){
            $lastName2 = null;
        }
        if($userId == ''){
            $userId = null;
        }
        if($fanjydaId == ''){
            $fanjydaId = null;
        }
        if($dni == ''){
            $dni = null;
        }
        if($illness == ''){
            $illness = null;
        }
        if($parentId == ''){
            $parentId = null;
        }

        try {
            return $this->model->modify($name, $lastName1, $lastName2, $sex, $userId, $fanjydaId, $dni, $birthDate, $phone, $email, $illness, $parentId, $beltId, $addressId, $classid, $judokaId);
        } catch (QueryException $e) {
        }
    }


    /**
     * Function that brings the  judokas
     * @return Judoka[]
     */
    public function getJudokas(): array
    {
        return $this->model->getAllJudokas();
    }

    /**
     * Gets one judoka
     * @param $judokaId
     * @return array
     */
    public function getOneJudoka($judokaId): array
    {
        return $this->model->getOneJudoka($judokaId);
    }
}
