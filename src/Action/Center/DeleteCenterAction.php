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
 * Class DeleteCenterAction
 * Class for delete a Center
 * @package WebFeletesDevelopers\Kazoku\Action\Center
 */
class DeleteCenterAction extends BaseJsonAction implements ActionInterface
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

        $codCentro = $data['centerId'];

        try {
            //$this->validateParameters($title, $body);
            $controller->deleteCenter(
                $codCentro
            );
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param int|null $codCentro
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?int $codCentro): void
    {
        if ($codCentro === null || $codCentro === 0) {
            throw InvalidParametersException::fromInvalidParameter('codCentro');
        }
    }
}
