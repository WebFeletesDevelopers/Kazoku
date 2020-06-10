<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseTwigAction;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class PasswordForgottenAction
 * Action to update a password.
 * @package WebFeletesDevelopers\Kazoku\Action\User
 */
class UpdatePasswordAction extends BaseTwigAction implements ActionInterface
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
        $params = $request->getQueryParams();
        $hash = $params['token'];

        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        if (! $userModel->findByEmailActivation($hash)) {
            header('Location: /');
        }

        $config = [
            'title' => 'Cambio de contraseña',
            'updateHash' => $hash,
        ];

        $compiledTwig = $this->render('user/finalRecovery', $config);
        $body->write($compiledTwig);

        return $response;
    }
}
