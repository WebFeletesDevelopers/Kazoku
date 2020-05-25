<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PruebaTraduccionAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        setlocale(LC_ALL, 'en_US.UTF-8');
        bindtextdomain('kazoku', __DIR__ . '/../locale');
        textdomain('kazoku');

        $template = $this->render('prueba');
        $body = $response->getBody();
        $body->write($template);

        return $response;
    }
}
