<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;

/**
 * Class judokasAction.
 * This class will generate the Judoka's page.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class JudokaDetailAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $judokaId = $args['id'];
        $database = ConnectionHelper::getConnection();
        $model = new JudokaModel($database);
        $controller = new JudokaController($model);
        $allJudokaInfo = $controller->getOneJudoka($judokaId);

        $modelClase = new ClaseModel($database);
        $controllerClase = new ClaseController($modelClase);
        $allClasses = $controllerClase->getClases();
        $value = intval($allJudokaInfo['classId']);
        $clase = $controllerClase->getClass([$value]);

        $modelCenter = new CentroModel($database);
        $controllerCenter = new CentroController($modelCenter);
        $center = $controllerCenter->getCenter($clase['centerId']);

        $classDays['daySplit'] = str_split(sprintf("%05d", decbin($clase['days'])));
        $body = $response->getBody();
        $arguments = [
            'title' => 'classadmin',
            'userName' => 'Alberto',
            'userId' => 0,
            'judoka' => $allJudokaInfo,
            'classes' => $allClasses,
            'class' => $clase,
            'days' => $classDays,
            'classDays' => $classDays,
            'center' => $center,
            'action' => 'judokas'
        ];
        $compiledTwig = $this->render('judokaDetail', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
