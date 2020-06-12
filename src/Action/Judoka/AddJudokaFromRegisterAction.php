<?php

namespace WebFeletesDevelopers\Kazoku\Action\Judoka;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\UploadedFile;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;
use WebFeletesDevelopers\Kazoku\Utils\Utils;

/**
 * Class AddJudoka
 * Class for add a judoka
 * @package WebFeletesDevelopers\Kazoku\Action\Judoka
 */
class AddJudokaFromRegisterAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $db = ConnectionHelper::getConnection();
        $model = new JudokaModel($db);
        $controller = new JudokaController($model);

        $data = $request->getParsedBody();
        $name = $data['name'];
        $lastname1 = $data['lastName1'];
        $lastname2 = $data['lastName2'];
        $dni = $data['dni'];
        $phone = (int)$data['phone'];
        $email = $data['email'];
        try {
            $this->validateParameters(
                $name,
                $lastname1,
                $email,
                $phone,
            );
            $controller->addJudokaFromRegister(
                $name,
                $lastname1,
                $phone,
                $email
            );
        } catch (InvalidParametersException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 400);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        if (! empty($_FILES)) {
            $directory = __DIR__ . '/../../../public/profile/';
            /** @var UploadedFile[] $uploadedFiles */
            $uploadedFiles = $request->getUploadedFiles();
            $hash = Utils::hashPassword($name . $phone);
            $uploadedFiles['dni-front']->moveTo($directory . "${hash}-front.png");
            $uploadedFiles['dni-back']->moveTo($directory . "${hash}-back.png");
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param string|null $name
     * @param string|null $lastname1
     * @param string|null $email
     * @param int|null $phone
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(
        ?string $name,
        ?string $lastname1,
        ?string $email,
        ?int $phone
    ): void {
        if ($name === null || trim($name) === '') {
            throw InvalidParametersException::fromInvalidParameter('name');
        }
        if ($lastname1 === null || trim($lastname1) === '') {
            throw InvalidParametersException::fromInvalidParameter('lastname1');
        }
        if ($email === null || trim($email) === '-') {
            throw InvalidParametersException::fromInvalidParameter('email');
        }
        if ($phone === null || $phone = 0) {
            throw InvalidParametersException::fromInvalidParameter('phone');
        }
    }
}
