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

    /**
     * Adds a judoka
     * @param string $name
     * @param string $lastName1
     * @param string $lastName2
     * @param int $sex
     * @param int $userId
     * @param int $fanjydaId
     * @param string $dni
     * @param string $birthDate
     * @param int $phone
     * @param string $email
     * @param string $illness
     * @param int $parentId
     * @param int $beltId
     * @param int $addressId
     * @param int $classid
     * @return bool
     */
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

    /**
     * Adds a judoka to BD from register
     * @param string $name
     * @param string $lastName1
     * @param int $phone
     * @param string $email
     * @return bool
     */
    public function addJudokaFromRegister(
        string $name,
        string $lastName1,
        int $phone,
        string $email
    ): bool {
        try {
            return $this->model->addJudokaFromRegister($name, $lastName1, $phone, $email);
        } catch (QueryException $e) {
        }
    }

    /**
     * delete a judoka from BD
     * @param int $judokaId
     * @return bool
     */
    public function deleteJudoka(
        int $judokaId
    ): bool {
        try {
            return $this->model->delete($judokaId);
        } catch (QueryException $e) {
        }
    }

    /**
     * Modifies a judoka
     * @param string $name
     * @param string $lastName1
     * @param string|null $lastName2
     * @param string|null $dni
     * @param string $email
     * @param string|null $illness
     * @param string $birthDate
     * @param int $sex
     * @param int|null $userId
     * @param int|null $parentId
     * @param int $addressId
     * @param int $beltId
     * @param int $classid
     * @param int $judokaId
     * @param int $phone
     * @param int|null $fanjydaId
     * @return bool
     */
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
        if($lastName2 == '' or $lastName2 == 'NaN'){
            $lastName2 = null;
        }
        if($userId == '' or $userId == 'NaN' ){
            $userId = null;
        }
        if($fanjydaId == '' or $fanjydaId == 'NaN'){
            $fanjydaId = null;
        }
        if($dni == '' or $dni == 'NaN'){
            $dni = null;
        }
        if($illness == '' or $illness == 'NaN'){
            $illness = null;
        }
        if($parentId == '' or $parentId == 'NaN'){
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
     * Gets one judoka by user id
     * @param $userId
     * @return array
     */
    public function getOneJudokaByuserId($userId): array
    {
        return $this->model->getOneJudokaByUserId($userId);
    }


    /**
     * Gets all judokas from a specific class
     * @param $classId
     * @return array
     */
    public function getJudokaByClass($classId): array
    {
        return $this->model->getJudokasByClassId($classId);
    }

    /**
     * Finds a judoka by some basic data
     * @param $name
     * @param $surname
     * @param $email
     * @return array
     */
    public function findJudoka($name,$surname,$email): array
    {
        return $this->model->findJudoka($name,$surname,$email);
    }

    /**
     * Links one judoka with his ID
     * @param $userId
     * @param $judokaId
     * @return bool
     * @throws QueryException
     */
    public function linkUser($userId,$judokaId): bool
    {
        return $this->model->linkWithUser($userId,$judokaId);
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
