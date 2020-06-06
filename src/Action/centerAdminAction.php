<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\CentroController;
use WebFeletesDevelopers\Kazoku\Model\CentroModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class centerAdminAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $database = ConnectionHelper::getConnection();
        $model = new CentroModel($database);
        $controller = new CentroController($model);
        $allCenters = $controller->getCentersAllData();

        $arguments = [
            'title' => 'centerAdmin',
            'userName' => 'Alberto',
            'userId' => 0,
            'centers' => $allCenters,
            'action' => 'center-admin'
        ];
        $compiledTwig = $this->render('centerAdmin', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
