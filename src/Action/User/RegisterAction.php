<?php

namespace WebFeletesDevelopers\Kazoku\Action\User;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\UserController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

class RegisterAction extends BaseJsonAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $pdo = ConnectionHelper::getConnection();
        $userModel = new UserModel($pdo);
        $userController = new UserController($userModel);

        $data = $request->getParsedBody();
        $name = $data['name'];
        $surname = $data['surname'];
        $secondSurname = $data['secondSurname'];
        $username = $data['username'];
        $phone = $data['phone'];
        $email = $data['email'];
        $password = $data['password'];
        $repeatPassword = $data['repeatPassword'];
        $rank = $data['rank'];

        $parametersToValidate = [
            'name' => $name,
            'surname' => $surname,
            'secondSurname' => $secondSurname,
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'rank' => $rank
        ];

        try {
            $this->validateParameters($parametersToValidate, $password, $repeatPassword, $rank);
            $userController->register(
                $rank,
                $username,
                $name,
                $phone,
                $surname,
                $secondSurname,
                $password,
                $email
            );
        } catch (InvalidParametersException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 400);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param array $parametersToValidate
     * @param string|null $password
     * @param string|null $repeatPassword
     * @param int|null $rank
     * @throws InvalidParametersException
     */
    private function validateParameters(
        array $parametersToValidate,
        ?string $password,
        ?string $repeatPassword,
        ?int $rank
    ): void {
        $this->validateFromArray($parametersToValidate);
        if ($password !== $repeatPassword) {
            throw InvalidParametersException::fromInvalidParameter('repeatPassword');
        }
        if (! in_array($rank, Rank::VALID_RANKS_FOR_REGISTER)) {
            throw InvalidParametersException::fromInvalidParameter('rank');
        }
    }
}
