<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
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
        $database = ConnectionHelper::getConnection();

        $model = new ClaseModel($database);
        $controller = new ClaseController($model);
        $currentClass = $controller->getCurrentClassId();
        $clase = $controller->getClass([$currentClass]);

        $centerModel = new CentroModel($database);
        $centerController = new CentroController($centerModel);
        $centro = $centerController->getCenter($clase['centerId']);

        $model = new JudokaModel($database);
        $controller = new JudokaController($model);
        $allJudokas = $controller->getJudokaByClass($currentClass);

        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);


        //echo $classController->getCurrentClassId();
        $body = $response->getBody();

        $arguments = [
            'photoRoute' => $fileRoute,
            'judokas' => $allJudokas,
            'class' => $clase,
            'center' => $centro,
            'date' => date('Y-m-d'),
            'action' => 'assistance'
        ];
        $compiledTwig = $this->render('assistance', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
