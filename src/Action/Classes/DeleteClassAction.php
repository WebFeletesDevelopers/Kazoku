<?php

namespace WebFeletesDevelopers\Kazoku\Action\Classes;

use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;

/**
 * Class DeleteClassAction
 * Class for deleting a class
 * @package WebFeletesDevelopers\Kazoku\Action\Classes
 */
class DeleteClassAction extends BaseJsonAction implements ActionInterface
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
        $model = new ClaseModel($db);
        $controller = new ClaseController($model);

        $data = $request->getParsedBody();

        $codClase = $data['codClase'];

        try {
            $this->validateParameters($codClase);
            $controller->deleteClass(
                $codClase
            );
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param string|null $codClase
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $codClase): void
    {
        if ($codClase === null || trim($codClase) === '') {
            throw InvalidParametersException::fromInvalidParameter('codClase');
        }
    }
}
