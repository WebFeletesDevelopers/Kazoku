<?php

namespace WebFeletesDevelopers\Kazoku\Action\Classes;

use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;

/**
 * Class CreateNewsAction
 * Class for creating a News
 * @package WebFeletesDevelopers\Kazoku\Action\News
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
        $model = new NoticiaModel($db);
        $controller = new NoticiaController($model);

        $data = $request->getParsedBody();

        $codNot = $data['codNot'];

        try {
            //$this->validateParameters($title, $body);
            $controller->deleteNews(
                $codNot
            );
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param string|null $title
     * @param string|null $body
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $title, ?string $body): void
    {
        if ($title === null || trim($title) === '') {
            throw InvalidParametersException::fromInvalidParameter('title');
        }
        if ($body === null || trim($body) === '') {
            throw InvalidParametersException::fromInvalidParameter('body');
        }
    }
}
