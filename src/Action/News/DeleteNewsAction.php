<?php

namespace WebFeletesDevelopers\Kazoku\Action\News;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class CreateNewsAction
 * Class for creating a News
 * @package WebFeletesDevelopers\Kazoku\Action\News
 */
class DeleteNewsAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser || ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            return $this->withJson($response, [], 403);
        }

        $db = ConnectionHelper::getConnection();
        $model = new NoticiaModel($db);
        $userModel = new UserModel($db);
        $controller = new NoticiaController($model, $userModel);

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
