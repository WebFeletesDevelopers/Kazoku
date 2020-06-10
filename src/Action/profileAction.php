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
class profileAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $database = ConnectionHelper::getConnection();
        $model = new NoticiaModel($database);
        $userModel = new UserModel($database);
        $controller = new NoticiaController($model, $userModel);

        $loggedInUser = $this->validateUserSession($userModel);
        $news = $loggedInUser
            ? $controller->getLatest()
            : $controller->getLatestPublic();

        $model = new JudokaModel($database);
        $controller = new JudokaController($model);
        $judoka = $controller->getOneJudokaByuserId($loggedInUser->id());
        $judokaId = intval($judoka['judokaId']);
        if($judokaId > 0){
            // get judoka
            $model = new JudokaModel($database);
            $controller = new JudokaController($model);
            $allJudokaInfo = $controller->getOneJudoka($judokaId);
            // get class
            $claseModel = new ClaseModel($database);
            $claseController = new ClaseController($claseModel);
            $value = intval($allJudokaInfo['classId']);
            $clase = $claseController->getClass([$value]);
            // get center
            $modelCenter = new CentroModel($database);
            $controllerCenter = new CentroController($modelCenter);
            $center = $controllerCenter->getCenter($clase['centerId']);
            // get profile pic
            $fileRoute = parent::getProfilePic($loggedInUser);
            // get address


        }

        $classDays['daySplit'] = str_split(sprintf("%05d", decbin($clase['days'])));
        $body = $response->getBody();
        $arguments = [
            'title' => 'classadmin',
            'userName' => 'Alberto',
            'userId' => 0,
            'judoka' => $judoka,
            'class' => $clase,
            'days' => $classDays,
            'photoRoute' => $fileRoute,
            'classDays' => $classDays,
            'center' => $center,
            'action' => 'judoka-myProfile'
        ];

        $body = $response->getBody();
        //$compiledTwig = $this->render('home');
        $compiledTwig = $this->render('profile',$arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
