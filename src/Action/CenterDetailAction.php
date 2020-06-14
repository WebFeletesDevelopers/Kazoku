<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class CenterDetailAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class CenterDetailAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = ['id']): ResponseInterface
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


        $model = new ClaseModel($database);
        $controller = new ClaseController($model);
        $classe = $controller->getClasesAllData();


        $codCentro = $args['id'];
        $modelCenter = new CentroModel($database);
        $controllerCenter = new CentroController($modelCenter);
        $center = $controllerCenter->getCenter($codCentro);

        $arguments = [
            'title' => 'kazoku',
            'userName' => 'Alberto',
            'userId' => 0,
            'class' => $classe,
            'photoRoute' => $fileRoute,
            'center' => $center,
            'action' => 'center-detail'
        ];
        $compiledTwig = $this->render('centerDetail', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
