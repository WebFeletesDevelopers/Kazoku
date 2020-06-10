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
class HomeAction extends BaseTwigAction implements ActionInterface
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

        $filename1 = '/img/profile' . $loggedInUser->id() . '.jpg';
        $filename2 = '/img/profile' . $loggedInUser->id() . '.jpg';
        $generic = "/img/profile/generic.png";
        $fileRoute = "";

        if (file_exists($filename1)) {
            $fileRoute = $filename1;
        } else if (file_exists($filename2)) {
            $fileRoute = $filename2;
        }
        else{
            $fileRoute = $generic;
        }


        $config = [
            'title' => 'titulo',
            'news' => $news,
            'photoRoute' => $fileRoute,
            'action' => 'home',
            'user' => $loggedInUser
        ];

        $compiledTwig = $this->render('home', $config);
        $body->write($compiledTwig);
        return $response;
    }
}
