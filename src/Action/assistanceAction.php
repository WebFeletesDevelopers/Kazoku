<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
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
        if($currentClass > 0){
            $clase = $controller->getClass([$currentClass]);
            $centerModel = new CentroModel($database);
            $centerController = new CentroController($centerModel);
            $centro = $centerController->getCenter($clase['centerId']);

            $model = new JudokaModel($database);
            $controllerJudoka = new JudokaController($model);
            $allJudokas = $controllerJudoka->getJudokaByClass($currentClass);
            $ClassDate = date('Y-m-d');

        }
        else{
            $allClasses = $controller->getClases();

            $claseId = $args['classId'];
            $date = $args['date'];
            if($claseId !== null && $date !== null){
                $ClassDate = date("Y-m-d", $date);
                $clase = $controller->getClass([$claseId]);
                // get judokas
                $model = new JudokaModel($database);
                $controllerJudoka = new JudokaController($model);
                $allJudokas = $controllerJudoka->getJudokaByClass($claseId);
            }


        }



        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);


        //echo $classController->getCurrentClassId();
        $body = $response->getBody();

        $arguments = [
            'photoRoute' => $fileRoute,
            'judokas' => $allJudokas,
            'class' => $clase,
            'allClasses' => $allClasses,
            'center' => $centro,
            'date' => $ClassDate,
            'action' => 'assistance'
        ];
        $compiledTwig = $this->render('assistance', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
