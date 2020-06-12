<?php

namespace WebFeletesDevelopers\Kazoku\Action\Judoka;

use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\AbsenceModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Entity\Alumno;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;


/**
 * Class AddJudokaClassAction
 * Class for add a judoka to a class
 * @package WebFeletesDevelopers\Kazoku\Action\News
 */
class AddJudokaClassAction extends BaseJsonAction implements ActionInterface
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $db = ConnectionHelper::getConnection();
        $model = new judokaModel($db);
        $controller = new JudokaController($model);

        $data = $request->getParsedBody();
        $judokaId = $data['judokaId'];
        $classId = $data['classId'];
        try {
            $this->validateParameters($judokaId, $classId);
            $controller->AddJudokaClass(
            $judokaId,
            $classId
            );
        } catch (InvalidParametersException | InvalidHashException $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 400);
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param int $judokaId
     * @param int $classId
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(int $judokaId, int $classId): void
    {
        if ($judokaId === null || $judokaId === 0) {
            throw InvalidParametersException::fromInvalidParameter('userId');
        }
        if ($classId === null || $classId === 0) {
            throw InvalidParametersException::fromInvalidParameter('classId');
        }
    }
}
