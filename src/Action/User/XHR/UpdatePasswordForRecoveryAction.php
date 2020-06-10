<?php

namespace WebFeletesDevelopers\Kazoku\Action\User\XHR;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;

/**
 * Class UpdatePasswordForRecoveryAction
 * Action to update an user password for recovery.
 * @package WebFeletesDevelopers\Kazoku\Action\User\XHR
 */
class UpdatePasswordForRecoveryAction extends BaseJsonAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $verificationModel = new VerificationModel($pdo);
        $mailService = new SendMailService();
        $userController = new UserController($userModel, $verificationModel, $mailService);

        $data = $request->getParsedBody();
        $hash = $data['hash'];
        $password = $data['password'];

        try {
            $userController->updatePasswordFromRecovery($hash, $password);
        } catch (InvalidCredentialsException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 404);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 200);
    }
}
