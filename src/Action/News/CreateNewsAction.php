<?php

namespace WebFeletesDevelopers\Kazoku\Action\News;

use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class CreateNewsAction
 * Class for creating a News
 * @package WebFeletesDevelopers\Kazoku\Action\News
 */
class CreateNewsAction extends BaseJsonAction implements ActionInterface
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
        $newsModel = new NoticiaModel($db);
        $userModel = new UserModel($db);
        $controller = new NoticiaController($newsModel, $userModel);

        $data = $request->getParsedBody();
        $title = $data['title'];
        $body = $data['body'];
        $isPublic = $data['public'] === 'true';
        $hash = $_COOKIE['hash'];

        try {
            $this->validateParameters($title, $body, $hash);
            $controller->addNews(
                $title,
                $body,
                new DateTime(),
                $isPublic,
                $hash
            );
        } catch (InvalidParametersException | InvalidHashException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 400);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param string|null $title
     * @param string|null $body
     * @param string|null $hash
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $title, ?string $body, ?string $hash): void
    {
        if ($title === null || trim($title) === '') {
            throw InvalidParametersException::fromInvalidParameter('title');
        }
        if ($body === null || trim($body) === '') {
            throw InvalidParametersException::fromInvalidParameter('body');
        }
        if ($hash === null || trim($hash) === '') {
            throw InvalidParametersException::fromInvalidParameter('hash');
        }
    }
}
