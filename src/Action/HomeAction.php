<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class HomeAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        /*
        setlocale(LC_ALL, 'en_US.UTF-8');
        bindtextdomain('kazoku', __DIR__ . '/../locale');
        textdomain('kazoku'); */
        $body = $response->getBody();

        $database = ConnectionHelper::getConnection();
        $model = new NoticiaModel($database);
        $controller = new NoticiaController($model);
        $news = $controller->getLatestPublic();

        $config = [
            'title' => 'titulo',
            'userName' => 'Alberto',
            'userId' => 0,
            'rango' => 0,
            'news' => $news
        ];

        $compiledTwig = $this->render('home', $config);
        $body->write($compiledTwig);
        return $response;
    }
}
