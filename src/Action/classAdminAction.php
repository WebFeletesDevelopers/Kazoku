<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Controller\UserControllerMin;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class classAdminAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $database = ConnectionHelper::getConnection();
        //get user infp
        $userModel = new UserModel($database);
        try {
            $loggedInUser = $this->validateUserSession($userModel);
        } catch (QueryException $e) {
        }
        $fileRoute = parent::getProfilePic($loggedInUser);
        if($this->loggedInUser == null){
            header('Location: /');
        }
        if ($this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }
        $model = new ClaseModel($database);
        $controller = new ClaseController($model);
        $allClass = $controller->getClasesAllData();


        // teacher info
        $modelUsers = new UserModel($database);
        $controllerUser = new UserControllerMin($modelUsers);
        $teachers  =$controllerUser->findByRankMin(1);



        $arguments = [
            'title' => 'Clases',
            'photoRoute' => $fileRoute,
            'teachers' => $teachers,
            'clases' => $allClass,
            'action' => 'class-admin'
        ];
        $compiledTwig = $this->render('classAdmin', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
