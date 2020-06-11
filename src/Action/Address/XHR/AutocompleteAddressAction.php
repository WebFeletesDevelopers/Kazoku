<?php

namespace WebFeletesDevelopers\Kazoku\Action\Address\XHR;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Controller\AddressController;
use WebFeletesDevelopers\Kazoku\Model\AddressModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;

/**
 * Class AutocompleteAddressAction
 * Action to get an address autocompletion data.
 * @package WebFeletesDevelopers\Kazoku\Action\Address\XHR
 */
class AutocompleteAddressAction extends BaseJsonAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $pdo = ConnectionHelper::getConnection();
        $addressModel = new AddressModel($pdo);
        $addressController = new AddressController($addressModel);

        $data = $request->getParsedBody();
        $input = $data['address'];

        try {
            $addresses = $addressController->getAddressByUserInput($input);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        $data = [];

        foreach ($addresses as $address) {
            $data[] = [
                'id' => $address->id(),
                'address' => $address->address(),
                'zip_code' => $address->zipCode(),
                'city' => $address->city(),
            ];
        }

        return $this->withJson($response, $data, 200);
    }
}
