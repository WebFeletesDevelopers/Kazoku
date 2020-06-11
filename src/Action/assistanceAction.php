<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class assistanceAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        // get basic info
        $body = $response->getBody();
        $database = ConnectionHelper::getConnection();
        $model = new JudokaModel($database);
        $controller = new JudokaController($model);
        $allJudokas = $controller->getJudokas();
        $body = $response->getBody();

        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);

        $classModel = new ClaseModel($database);
        $classController = new ClaseController($classModel);
        $classes = $classController->getClasesAllData();

        echo $classController->getCurrentClassId();
        $arguments = [
            'photoRoute' => $fileRoute,
            'judokas' => $allJudokas,
            'action' => 'judokas'
        ];
        $compiledTwig = $this->render('assistance', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
