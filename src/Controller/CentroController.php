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


    public function addCenter(
        string $name,
        string $direction,
        int $zip,
        int $phone
    ): bool {
        return $this->model->add($name, $direction, $zip, $phone);
    }
    public function deleteCenter(
        int $centerCode
    ): bool {
        try {
            return $this->model->delete($centerCode);
        } catch (DeleteException $e) {
        }
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
