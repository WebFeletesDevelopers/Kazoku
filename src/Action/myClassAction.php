<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\AbsenceController;
use WebFeletesDevelopers\Kazoku\Controller\AddressController;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\AbsenceModel;
use WebFeletesDevelopers\Kazoku\Model\AddressModel;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class myClassAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $database = ConnectionHelper::getConnection();
        $userModel = new UserModel($database);

        $loggedInUser = $this->validateUserSession($userModel);

        if ($loggedInUser->rank() !== Rank::PUPIL) {
            header('Location: /');
        }

        $fileRoute = parent::getProfilePic($loggedInUser);

        if ($loggedInUser->id() !== null){
            $model = new JudokaModel($database);
            $controller = new JudokaController($model);
            $judoka = $controller->getOneJudokaByuserId($loggedInUser->id());
            if($judoka['judokaId'] != null && $judoka['judokaId'] > 0) {
                // get judoka
                $judokaId = intval($judoka['judokaId']);

                $model = new JudokaModel($database);
                $controller = new JudokaController($model);
                $allJudokaInfo = $controller->getOneJudoka($judokaId);
                // get absences
                $absenceModel = new AbsenceModel($database);
                $absenceController = new AbsenceController($absenceModel);
                $absencesMonth = $absenceController->getAllFromJudokaMonth($allJudokaInfo['judokaId'],date('m'));
                $allAbscense = $absenceController->getAllFromJudoka($allJudokaInfo['judokaId']);
                $absenceNumber = sizeof($absencesMonth);
                // get class
                $claseModel = new ClaseModel($database);
                $claseController = new ClaseController($claseModel);
                $value = intval($allJudokaInfo['classId']);
                $clase = $claseController->getClass([$value]);
                $classDays['daySplit'] = str_split(sprintf("%05d", decbin($clase['days'])));
                // get center
                if($clase != null){
                    $modelCenter = new CentroModel($database);
                    $controllerCenter = new CentroController($modelCenter);
                    $center = $controllerCenter->getCenter($clase['centerId']);
                }
                // get profile pic
                $fileRoute = parent::getProfilePic($loggedInUser);
                // get address
                if($judoka['addressId'] != null){
                    $addressModel = new AddressModel($database);
                    $addressController = new AddressController($addressModel);
                    $address = $addressController->getAddressById($judoka['addressId']);
                }
            }
        }

        $allAbscense ??= [];

        $arguments = [
            'title' => 'Kazoku | Perfil',
            'judoka' => $judoka,
            'class' => $clase,
            'days' => $classDays,
            'photoRoute' => $fileRoute,
            'classDays' => $classDays,
            'absencesMonth' => $absencesMonth,
            'absenceNumber' => $absenceNumber,
            'allAbsences' => $allAbscense,
            'allAbsencesNumber' => count($allAbscense),
            'center' => $center,
            'address' => $address,
            'action' => 'judoka-myProfile'
        ];

            $body = $response->getBody();
            $compiledTwig = $this->render('myClass', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
