<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseTwigAction;

/**
 * Class PasswordForgottenAction
 * Action to request a password update.
 * @package WebFeletesDevelopers\Kazoku\Action\User
 */
class PasswordForgottenAction extends BaseTwigAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();

        $config = [
            'title' => 'Olvidé la contraseña',
        ];

        $compiledTwig = $this->render('user/startPasswordRecovery', $config);
        $body->write($compiledTwig);

        return $response;
    }
}
