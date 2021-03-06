<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Controller\UserControllerMin;
use WebFeletesDevelopers\Kazoku\Model\AddressModel;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class judokasAction.
 * This class will generate the Judoka's page.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class JudokaDetailAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser || ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }

        $database = ConnectionHelper::getConnection();
        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);

        $judokaId = $args['id'];
        if ($judokaId > 0){
            // get judoka
            $model = new JudokaModel($database);
            $controller = new JudokaController($model);
            $allJudokaInfo = $controller->getOneJudoka($judokaId);

            if ($allJudokaInfo['parentId'] != null){
               //get parent
               $parentModel = new UserModel($database);
               $parentController = new UserControllerMin($parentModel);
               $parent = $parentController->findByIDmin($allJudokaInfo['parentId']);
            }

            if ($allJudokaInfo['classId'] != null){
                //get clase
                $modelClase = new ClaseModel($database);
                $controllerClase = new ClaseController($modelClase);
                $allClasses = $controllerClase->getClases();
                $value = intval($allJudokaInfo['classId']);
                $clase = $controllerClase->getClass([$value]);

                if($clase != null){
                    //get center
                    $modelCenter = new CentroModel($database);
                    $controllerCenter = new CentroController($modelCenter);
                    $center = $controllerCenter->getCenter($clase['centerId']);
                }
            }

            if ($allJudokaInfo['addressId'] !== null) {
                $addressModel = new AddressModel($database);
                $address = $addressModel->getAddress($allJudokaInfo['addressId']);
            }
        }
            $database = ConnectionHelper::getConnection();
            $modelClase = new ClaseModel($database);
            $controllerClase = new ClaseController($modelClase);
            $allClasses = $controllerClase->getClasesAllData();

            // get all centers (if there's gonna be a change
            $modelCenter = new CentroModel($database);
            $controllerCenter = new CentroController($modelCenter);
            $centers = $controllerCenter->getCentersAllData();

            // get all parents (reduced data)
            $parentModel = new UserModel($database);
            $parentController = new UserControllerMin($parentModel);
            $allParents = $parentController->findByRankMin(2);

            // get all users (judokas)allusers
            $allusers = $parentController->findByRankMin(3);



        $classDays['daySplit'] = str_split(sprintf("%05d", decbin($clase['days'])));
        $body = $response->getBody();
        $arguments = [
            'title' => 'classadmin',
            'userName' => 'Alberto',
            'userId' => 0,
            'judoka' => $allJudokaInfo,
            'photoRoute' => $fileRoute,
            'classes' => $allClasses,
            'days' => $classDays,
            'parent' => $parent,
            'allParents' => $allParents,
            'allusers' => $allusers,
            'classDays' => $classDays,
            'center' => $center,
            'centers' => $center,
            'action' => 'judoka-detail',
            'address' => $address ?? null
        ];
        $compiledTwig = $this->render('judokaDetail', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
