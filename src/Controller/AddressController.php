<?php

namespace WebFeletesDevelopers\Kazoku\Controller;

use WebFeletesDevelopers\Kazoku\Model\AddressModel;
use WebFeletesDevelopers\Kazoku\Model\Entity\Direccion;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;

/**
 * Class AddressController
 * Address controller.
 * @package WebFeletesDevelopers\Kazoku\Controller
 */
class AddressController
{
    private AddressModel $addressModel;

    public function __construct(
         AddressModel $addressModel
    ) {
        $this->addressModel = $addressModel;
    }

    public function addNews(
        int $zip,
        string $locality,
        string $province,
        string $address
    ): ?Direccion {
        try {
            return $this->addressModel->add($zip, $locality, $province, $address);
        } catch (QueryException $e) {
            return null;
        }
    }

    /**
     * Gets all addresses
     * @return direccion[]
     */
    public function getAllAddresses(): array
    {
        return $this->addressModel->getAll();
    }

    /**
     * Get an address by id
     * @param int $id
     * @return array
     */
    public function getAddressById(int $id): array
    {
        return $this->addressModel->getAddress($id);
    }

    /**
     * Deletes an address from db
     * @param int $id
     * @return bool
     * @throws QueryException
     */
    public function deteleAddress(
        int $id
    ): bool {
        return $this->addressModel->delete($id);
    }

    /**
     * @param string $input
     * @return Direccion[]
     */
    public function getAddressByUserInput(string $input): array
    {
        return $this->addressModel->getByNaturalSearch($input);
    }
}
