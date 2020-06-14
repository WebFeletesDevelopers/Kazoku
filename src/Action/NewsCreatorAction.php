<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class NewsCreatorAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser || ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }

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

        $arguments = [
            'title' => 'titulo',
            'userName' => 'Alberto',
            'userId' => 0,
            'photoRoute' => $fileRoute,
            'action' => 'news-creator'
        ];
        $compiledTwig = $this->render('newsCreator', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
