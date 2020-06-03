<?php

namespace WebFeletesDevelopers\Kazoku\Action\News;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseTwigAction;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;

/**
 * Class CreateNewsAction
 * Class for creating a News
 * @package WebFeletesDevelopers\Kazoku\Action\News
 */
class CreateNewsAction extends BaseTwigAction implements ActionInterface
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
        $title = $data['title'];
        $body = $data['body'];
        $isPublic = $data['public'] === 'true';

        if (! $this->validateParameters($title, $body)) {
            return $response->withStatus(400);
        }

        $result = $controller->addNews(
            $title,
            $body,
            new DateTime(),
            'elautor',
            $isPublic
        );

        return $result
            ? $response->withStatus(201)
            : $response->withStatus(500);
    }

    /**
     * @param string|null $title
     * @param string|null $body
     * @param bool|null $isPublic
     * @return bool
     */
    private function validateParameters(?string $title, ?string $body): bool
    {
        return ($title !== null || $title !== '')
            && ($body !== null || $body !== '');
    }
}
