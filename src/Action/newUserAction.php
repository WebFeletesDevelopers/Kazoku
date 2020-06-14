<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class newUserAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $database = ConnectionHelper::getConnection();

        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);
        if($loggedInUser == null){
            $body = $response->getBody();
            $compiledTwig = $this->render('matte');
            $body->write($compiledTwig);
            return $response;
        }

        //$compiledTwig = $this->render('home');
        $compiledTwig = $this->render('newUser',['title' => "titulo",'userName' => "Alberto",'title' => "titulo",'userId' => 0]);
        $body->write($compiledTwig);
        return $response;
    }
}
