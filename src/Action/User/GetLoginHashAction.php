<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\LoginHashController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Exception\User\InvalidCredentialsException;
use WebFeletesDevelopers\Kazoku\Model\LoginHashModel;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class GetLoginHashAction
 * Action to get a login hash, activating an user session.
 * @package WebFeletesDevelopers\Kazoku\Action\User
 */
class GetLoginHashAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $hashModel = new LoginHashModel($pdo);
        $hashController = new LoginHashController($userModel, $hashModel);

        $data = $request->getParsedBody();
        $username = $data['username'];
        $password = $data['password'];

        try {
            $this->validateParameters($username, $password);
            $hash = $hashController->getHashFromLoginData($username, $password);
        } catch (InvalidCredentialsException $e) {
            $data = ['message' => 'Invalid credentials'];
            return $this->withJson($response, $data, 401);
        } catch (InvalidParametersException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 400);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        $data = ['hash' => $hash];
        return $this->withJson($response, $data, 200);
    }

    /**
     * @param string|null $username
     * @param string|null $password
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $username, ?string $password): void
    {
        if ($username === null || trim($username) === '') {
            throw InvalidParametersException::fromInvalidParameter('username');
        }
        if ($password === null || trim($password) === '') {
            throw InvalidParametersException::fromInvalidParameter('password');
        }
    }
}
