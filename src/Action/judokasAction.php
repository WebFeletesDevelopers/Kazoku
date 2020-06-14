<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
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
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws QueryException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser || ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }

        $database = ConnectionHelper::getConnection();
        $model = new JudokaModel($database);
        $controller = new JudokaController($model);
        $allJudokas = $controller->getJudokas();
        $body = $response->getBody();

        if ($this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            header('Location: /');
        }

        $userModel = new UserModel($database);
        $loggedInUser = $this->validateUserSession($userModel);
        $fileRoute = parent::getProfilePic($loggedInUser);

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
