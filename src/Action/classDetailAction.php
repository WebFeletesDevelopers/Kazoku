<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Controller\UserControllerMin;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class classDetailAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = ['id']): ResponseInterface
    {
        // get class
        $body = $response->getBody();
        $codClase = $args['id'];
        $database = ConnectionHelper::getConnection();
        //session info
        $userModel = new UserModel($database);
        try {
            $loggedInUser = $this->validateUserSession($userModel);
        } catch (QueryException $e) {
        }
        $fileRoute = parent::getProfilePic($loggedInUser);

        if($this->loggedInUser == null){
            header('Location: /');
        }
        if ($this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }


        $model = new ClaseModel($database);
        $controller = new ClaseController($model);
        $classe = $controller->getClass([$codClase]);

        //get teachers
        $modelUsers = new UserModel($database);
        $controllerUser = new UserControllerMin($modelUsers);
        $teachers  =$controllerUser->findByRankMin(1);

        // get center
        $modelCenter = new CentroModel($database);
        $controllerCenter = new CentroController($modelCenter);
        $centers = $controllerCenter->getCentersAllData();
        $schedule = explode("-",$classe['schedule'].'-');
        // get judokas
        $judokaModel = new JudokaModel($database);
        $judokaController = new JudokaController($judokaModel);
        $judokas = $judokaController->getJudokaByClass($codClase);
        $allJudokas = $judokaController->getJudokas();



        $days['daySplit'] = str_split(sprintf("%05d", decbin($classe['days'])));
        $arguments = [
            'title' => 'kazoku',
            'userName' => 'Alberto',
            'userId' => 0,
            'class' => $classe,
            'teachers' => $teachers,
            'photoRoute' => $fileRoute,
            'allJudokas' => $allJudokas,
            'centers' => $centers,
            'judokas' => $judokas,
            'day' => $days,
            'schedule' => $schedule,
            'action' => 'class-detail'
        ];
        $compiledTwig = $this->render('classDetail', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
