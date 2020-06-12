<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\Entity\Centro;
use WebFeletesDevelopers\Kazoku\Model\Exception\DeleteException;
use WebFeletesDevelopers\Kazoku\Model\Exception\InsertException;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;

/**
 * Class center controller
 * Center controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class CentroController
{
    private CentroModel $model;

    public function __construct(CentroModel $model)
    {
        $this->model = $model;
    }

    /**
     * Adds a center to the database
     * @param string $name
     * @param string $direction
     * @param int $zip
     * @param int $phone
     * @return bool
     */
    public function addCenter(
        string $name,
        string $direction,
        int $zip,
        int $phone
    ): bool {
        return $this->model->add($name, $direction, $zip, $phone);
    }

    /**
     * Modifies a center from the database
     * @param string $name
     * @param string $direction
     * @param int $zip
     * @param int $phone
     * @param int $centerId
     * @return bool
     */
    public function modifyCenter(
        string $name,
        string $direction,
        int $zip,
        int $phone,
        int $centerId
    ): bool {
        return $this->model->modify($name, $direction, $zip, $phone, $centerId);
    }

    /**
     * Deletes a center from the database
     * @param int $centerCode
     * @return bool
     */
    public function deleteCenter(
        int $centerCode
    ): bool {
        try {
            return $this->model->delete($centerCode);
        } catch (DeleteException $e) {
        }
    }


    /**
     * Get a center
     * @param $centerId
     * @return array
     */
    public function getCenter($centerId): array
    {
        return $this->model->getCentro($centerId);
    }

    /**
     * Function that brings the  centers
     * @return Centro[]
     */
    public function getCenters(): array
    {
        return $this->model->getCentros();
    }
    /**
     * Get all centers with more data
     * @return array
     */
    public function getCentersAllData(): array
    {
        return $this->model->getCenterAllData();
    }


}
