<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class HomeAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $compiledTwig = $this->render('home');
        $body->write($compiledTwig);
        return $response;
    }
}
