<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;

/**
 * Class judokasAction.
 * This class will generate the Judoka's page.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class judokasAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $database = ConnectionHelper::getConnection();
        $model = new JudokaModel($database);
        $controller = new JudokaController($model);
        $allJudokas = $controller->getJudokas();
        $body = $response->getBody();
        $arguments = [
            'title' => 'classadmin',
            'userName' => 'Alberto',
            'userId' => 0,
            'judokas' => $allJudokas,
            'action' => 'judokas'
        ];
        $compiledTwig = $this->render('judokas', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
