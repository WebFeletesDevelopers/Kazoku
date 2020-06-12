<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseTwigAction;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;
use WebFeletesDevelopers\Kazoku\Model\VerificationModel;
use WebFeletesDevelopers\Kazoku\Service\Mail\SendMailService;

/**
 * Class ActivateUserAction
 * Action to activate an user account.
 * @package WebFeletesDevelopers\Kazoku\Action\User
 */
class ActivateUserAction extends BaseTwigAction implements ActionInterface
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
     * @throws InvalidCredentialsException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $body = $response->getBody();
        $params = $request->getQueryParams();

        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $verificationModel = new VerificationModel($pdo);
        $emailService = new SendMailService();
        $userController = new UserController($userModel, $verificationModel, $emailService);
        $config = [
            'title' => 'Activacion',
        ];

        try {
            $userController->activateByEmail($params['token'] ?? '');
        } catch (InvalidCredentialsException $exception) {
            $compiledTwig = $this->render('user/alreadyActivated', $config);
            $body->write($compiledTwig);
            return $response;
        }

        $compiledTwig = $this->render('user/activate', $config);
        $body->write($compiledTwig);

        return $response;
    }
}
