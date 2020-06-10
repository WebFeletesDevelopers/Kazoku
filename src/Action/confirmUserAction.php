<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class confirmUserAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();

        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $verificationModel = new VerificationModel($pdo);
        $mailService = new SendMailService();
        $userController = new UserController($userModel, $verificationModel, $mailService);
        $users = $userController->listNotConfirmed($_COOKIE['hash']);
        $config = [
            'title' => _('Confirmar usuarios'),
            'users' => $users,
            'action' => 'confirm-users-by-trainer'
        ];
        $compiledTwig = $this->render('confirmUser', $config);
        $body->write($compiledTwig);
        return $response;
    }
}
