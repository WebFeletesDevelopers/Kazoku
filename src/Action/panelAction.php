<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class panelAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();

        $database = ConnectionHelper::getConnection();
        $model = new NoticiaModel($database);
        $userModel = new UserModel($database);
        $controller = new NoticiaController($model, $userModel);

        $loggedInUser = $this->validateUserSession($userModel);
        $news = $loggedInUser
            ? $controller->getLatest()
            : $controller->getLatestPublic();
        $fileRoute = parent::getProfilePic($loggedInUser);


        $config = [
            'title' => 'Panel',
            'news' => $news,
            'photoRoute' => $fileRoute,
            'action' => 'panel',
            'user' => $loggedInUser
        ];

        $compiledTwig = $this->render('panel', $config);
        //$compiledTwig = $this->render('home');
        $body->write($compiledTwig);
        return $response;
    }
}
