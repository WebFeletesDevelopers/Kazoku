<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class classAdminAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $database = ConnectionHelper::getConnection();
        $model = new ClaseModel($database);
        $controller = new ClaseController($model);
        $allClass = $controller->getClasesAllData();

        $arguments = [
            'title' => 'classadmin',
            'userName' => 'Alberto',
            'userId' => 0,
            'clases' => $allClass,
            'action' => 'class-admin'
        ];
        $compiledTwig = $this->render('classAdmin', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
