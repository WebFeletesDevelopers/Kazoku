<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;

/**
 * Class ActivateUserByTrainerAction
 * Action used to activate an user by a trainer
 * @package WebFeletesDevelopers\Kazoku\Action\User
 */
class ActivateUserByTrainerAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws QueryException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            return $this->withJson($response, [], 403);
        }

        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $verificationModel = new VerificationModel($pdo);
        $mailService = new SendMailService();
        $userController = new UserController($userModel, $verificationModel, $mailService);

        $data = $request->getParsedBody();
        $userId = $data['userId'];

        $judokaModel = new judokaModel($pdo);
        $judokaController = new judokaController($judokaModel);
        $user = $userController->findByIDmin($userId);

        try {
            $userController->activateByTrainer($userId, $_COOKIE['hash']);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }
        if($user['rank'] == '3' || $user['rank'] == 3){
            $judoka = $judokaController->findJudoka($user['name'],$user['surname'],$user['email']);
            if(
                $judoka['name'] == $user['name'] &&
                $judoka['lastName1'] == $user['surname'] &&
                $judoka['email'] == $user['email']

            ){
                $exito = $judokaController->linkUser($userId,$judoka['id']);
            }
        }
        return $this->withJson($response, [], 200);
    }
}
