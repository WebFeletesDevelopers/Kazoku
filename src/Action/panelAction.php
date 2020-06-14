<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
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
        if($loggedInUser == null){
            $body = $response->getBody();
            $compiledTwig = $this->render('matte');
            $body->write($compiledTwig);
            return $response;
        }

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
