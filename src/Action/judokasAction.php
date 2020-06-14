<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

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

        $userModel = new UserModel($database);
        try {
            $loggedInUser = $this->validateUserSession($userModel);
        } catch (QueryException $e) {
        }
        $fileRoute = parent::getProfilePic($loggedInUser);
        if($loggedInUser == null){
            $body = $response->getBody();
            $compiledTwig = $this->render('matte');
            $body->write($compiledTwig);
            return $response;
        }

        $arguments = [
            'title' => 'Judokas',
            'photoRoute' => $fileRoute,
            'judokas' => $allJudokas,
            'action' => 'judokas'
        ];
        $compiledTwig = $this->render('judokas', $arguments);
        $body->write($compiledTwig);
        return $response;
    }
}
