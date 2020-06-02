<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class NewsCreatorAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {

        $body = $response->getBody();
        $arguments = [
            'title' => 'titulo',
            'userName' => 'Alberto',
            'userId' => 0,
            'action' => 'news-creator'
        ];
        $compiledTwig = $this->render('newsCreator', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
