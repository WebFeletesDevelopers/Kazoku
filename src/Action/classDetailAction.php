<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class classDetailAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = ['id']): ResponseInterface
    {
        $body = $response->getBody();
        $codClase = $args['id'];
        $database = ConnectionHelper::getConnection();
        $model = new ClaseModel($database);
        $controller = new ClaseController($model);
        $classe = $controller->getClass([$codClase]);

        $modelCenter = new CentroModel($database);
        $controllerCenter = new CentroController($modelCenter);
        $centers = $controllerCenter->getCentersAllData();
        $schedule = explode("-",$classe['schedule'].'-');

        $days['daySplit'] = str_split(sprintf("%05d", decbin($classe['days'])));
        $arguments = [
            'title' => 'kazoku',
            'userName' => 'Alberto',
            'userId' => 0,
            'class' => $classe,
            'centers' => $centers,
            'day' => $days,
            'schedule' => $schedule,
            'action' => 'class-detail'
        ];
        $compiledTwig = $this->render('classDetail', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
