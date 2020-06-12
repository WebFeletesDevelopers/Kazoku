<?php

namespace WebFeletesDevelopers\Kazoku\Action\Judoka;

use Cassandra\Date;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;

/**
 * Class AddJudoka
 * Class for add a judoka
 * @package WebFeletesDevelopers\Kazoku\Action\Judoka
 */
class AddJudokaAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $db = ConnectionHelper::getConnection();
        $model = new JudokaModel($db);
        $controller = new JudokaController($model);

        $data = $request->getParsedBody();
        $name = $data['name'];
        $lastname1 = $data['lastName1'];
        $lastname2 = $data['lastName2'];
        $sex = intval($data['sex']);
        $fanjydaId = intval($data['idFanjyda']);
        $dni = $data['dni'];
        $birthDate = $data['birthDate'];
        $phone = intval($data['phone']);
        $email = $data['email'];
        $illness = $data['illness'];
        $userId = intval($data['userId']);
        $parentId = intval($data['parentId']);
        $addressId = intval($data['addressId']);
        $beltId = intval($data['beltId']);
        $classId = intval($data['classId']);
        $judokaId = intval($data['judokaId']);
        try {
            $this->validateParameters(
                $name,
                $lastname1,
                $lastname2,
                $dni,
                $email,
                $illness,
                $birthDate,
                $sex,
                $userId,
                $parentId,
                $addressId,
                $beltId,
                $classId,
                $phone,
                $fanjydaId
            );
            $controller->addJudoka(
                $name,
                $lastname1,
                $lastname2,
                $sex,
                $userId,
                $fanjydaId,
                $dni,
                $birthDate,
                $phone,
                $email,
                $illness,
                $parentId,
                $beltId,
                $addressId,
                $classId
            );
        } catch (InvalidParametersException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 400);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param string|null $name
     * @param string|null $lastname1
     * @param string|null $lastname2
     * @param string|null $dni
     * @param string|null $email
     * @param string|null $illness
     * @param Date|null $birthDate
     * @param int|null $sex
     * @param int|null $userId
     * @param int|null $parentId
     * @param int|null $addressId
     * @param int|null $beltId
     * @param int|null $classId
     * @param int|null $phone
     * @param int|null $fanjydaId
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $name,
                                        ?string $lastname1,
                                        ?string $lastname2,
                                        ?string $dni,
                                        ?string $email,
                                        ?string $illness,
                                        ?string $birthDate,
                                        ?int $sex,
                                        ?int $userId,
                                        ?int $parentId,
                                        ?int $addressId,
                                        ?int $beltId,
                                        ?int $classId,
                                        ?int $phone,
                                        ?int $fanjydaId
    ): void
    {
        if ($name === null || trim($name) === '') {
            throw InvalidParametersException::fromInvalidParameter('name');
        }
        if ($lastname1 === null || trim($lastname1) === '') {
            throw InvalidParametersException::fromInvalidParameter('lastname1');
        }
        if ($birthDate === null || trim($birthDate) === '') {
            throw InvalidParametersException::fromInvalidParameter('birthdate');
        }
        if (trim($email) === '-') {
            throw InvalidParametersException::fromInvalidParameter('email');
        }
        if ($sex === null || $sex = 0) {
            throw InvalidParametersException::fromInvalidParameter('sex');
        }
        if ($beltId === null || $beltId == 0) {
            throw InvalidParametersException::fromInvalidParameter('beltId');
        }
        if ($classId === null || $classId == 0) {
            throw InvalidParametersException::fromInvalidParameter('classId');
        }
        if ($phone == 0) {
            throw InvalidParametersException::fromInvalidParameter('phone');
        }
    }
}
