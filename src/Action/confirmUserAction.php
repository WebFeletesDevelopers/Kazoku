<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
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
        $pdo = ConnectionHelper::getConnection();

        $body = $response->getBody();
        $userModel = new UserModel($pdo);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);
        if ($this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }

        $userModel = new UserModel($pdo);
        $verificationModel = new VerificationModel($pdo);
        $mailService = new SendMailService();
        $userController = new UserController($userModel, $verificationModel, $mailService);

        try {
            $users = $userController->listNotConfirmed($_COOKIE['hash']);
        } catch (InvalidHashException $e) {
        } catch (QueryException $e) {
        }
        $config = [
            'title' => _('Confirmar usuarios'),
            'users' => $users,
            'photoRoute' => $fileRoute,
            'action' => 'confirm-users-by-trainer'
        ];
        $compiledTwig = $this->render('confirmUser', $config);
        $body->write($compiledTwig);
        return $response;
    }
}
