<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class virtualClassAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser) {
            header('Location: /');
        }

        $body = $response->getBody();
        $compiledTwig = $this->render('virtualClass',['title' => "titulo",'userName' => "Alberto",'title' => "titulo",'userId' => 0]);
        $body->write($compiledTwig);
        return $response;
    }
}
