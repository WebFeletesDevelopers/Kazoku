<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\UserControllerMin;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class judokasAction.
 * This class will generate the Judoka's page.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class usersAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $database = ConnectionHelper::getConnection();
        $model = new userModel($database);
        $controller = new userControllerMin($model);
        $allUsers = $controller->findAllMin();

        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);
        if($this->loggedInUser == null){
            header('Location: /');
        }
        if ($this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }
        $body = $response->getBody();

        $arguments = [
            'title' => 'Judokas',
            'photoRoute' => $fileRoute,
            'users' => $allUsers,
            'action' => 'judokas'
        ];
        $compiledTwig = $this->render('users', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
