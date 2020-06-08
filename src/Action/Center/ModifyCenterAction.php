<?php

namespace WebFeletesDevelopers\Kazoku\Action\Center;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;

/**
 * Class modifyCenterAction
 * Class for creating a center
 * @package WebFeletesDevelopers\Kazoku\Action\Center
 */
class ModifyCenterAction extends BaseJsonAction implements ActionInterface
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
        $model = new CentroModel($db);
        $controller = new CentroController($model);

        $data = $request->getParsedBody();
        $name = $data['name'];
        $direction = $data['direction'];
        $zip = $data['zip'];
        $phone = $data['phone'];
        $centerId = $data['centerId'];

        try {
            $this->validateParameters($name,$direction,$zip,$phone);
            $controller->modifyCenter(
                $name,
                $direction,
                $zip,
                $phone,
                $centerId
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
     * @param string|null $direction
     * @param int|null $zip
     * @param int|null $phone
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $name,
                                        ?string $direction,
                                        ?int $zip,
                                        ?int $phone): void
    {
        if ($direction === null || trim($direction) === '') {
            throw InvalidParametersException::fromInvalidParameter('direction');
        }
        if ($name === null || trim($name) === '') {
            throw InvalidParametersException::fromInvalidParameter('name');
        }
        if ($zip === null || $zip = 0) {
            throw InvalidParametersException::fromInvalidParameter('zip');
        }
        if ($phone === null || $phone = 0) {
            throw InvalidParametersException::fromInvalidParameter('phone');
        }
    }
}
