<?php

namespace WebFeletesDevelopers\Kazoku\Action\User\XHR;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Controller\AddressController;
use WebFeletesDevelopers\Kazoku\Model\AddressModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Entity\Alumno;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\AddressFactory;
use WebFeletesDevelopers\Kazoku\Model\Entity\Factory\JudokaFactory;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;

/**
 * Class UpdateAddressAction
 * Action to update an user address
 * @package WebFeletesDevelopers\Kazoku\Action\User\XHR
 */
class UpdateAddressAction extends BaseJsonAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser) {
            header('Location: /');
        }

        $pdo = ConnectionHelper::getConnection();
        $addressModel = new AddressModel($pdo);
        $addressController = new AddressController($addressModel);
        $pupilController = new JudokaModel($pdo);

        $data = $request->getParsedBody();
        $addressId = $data['addressId'] ?? null;
        $judokaId = $data['userId'];
        $addressAddress = $data['addressAddress'];
        $addressZip = $data['addressZip'];
        $addressCity = $data['addressCity'];

        //fixme
        if ($addressId && $addressId !== 'NaN' && $addressId !== 0) {
            $ar = [$addressController->getAddressById($addressId)];
            $address = AddressFactory::fromMysqlRows($ar)[0];
        } else {
            $address = $addressController->addNews($addressZip, $addressCity, 'Malaga', $addressAddress);
        }
        $jr = [$pupilController->getOneJudoka($judokaId)];
        /** @var Alumno $pupil */
        $pupil = JudokaFactory::fromMysqlRows($jr)[0];
        $pupil->setAddressId($address->id());
        $pupilController->update($pupil);

        return $this->withJson($response, [], 200);
    }
}
