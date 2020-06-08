<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseTwigAction;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;

/**
 * Class ActivateUserAction
 * Action to activate an user account.
 * @package WebFeletesDevelopers\Kazoku\Action\User
 */
class ActivateUserAction extends BaseTwigAction implements ActionInterface
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

        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $verificationModel = new VerificationModel($pdo);
        $emailService = new SendMailService();
        $userController = new UserController($userModel, $verificationModel, $emailService);

        $userController->activateByEmail($params['token']);

        $config = [
            'title' => 'titulo',
        ];

        $compiledTwig = $this->render('user/activate', $config);
        $body->write($compiledTwig);

        return $response;
    }
}
