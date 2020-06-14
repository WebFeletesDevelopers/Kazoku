<?php

namespace WebFeletesDevelopers\Kazoku\Action\Assistance;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\AbsenceController;
use WebFeletesDevelopers\Kazoku\Model\AbsenceModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Entity\Absence;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;

/**
 * Class CreateNewsAction
 * Class for creating a News
 * @package WebFeletesDevelopers\Kazoku\Action\News
 */
class AssistanceSendAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser && ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            return $this->withJson($response, [], 403);
        }

        $db = ConnectionHelper::getConnection();
        $model = new AbsenceModel($db);
        $controller = new AbsenceController($model);

        $data = $request->getParsedBody();
        $judokaId = $data['userId'];
        $classId = $data['classId'];
        $date = $data['date'];
        $absence = new Absence(0,$judokaId,$classId,$date);
        try {
            $this->validateParameters($judokaId, $classId, $date);
            $controller->new(
             $absence
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
     * @param string $date
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(int $judokaId, int $classId,  string $date): void
    {
        if ($judokaId === null || $judokaId === 0) {
            throw InvalidParametersException::fromInvalidParameter('userId');
        }
        if ($classId === null || $classId === 0) {
            throw InvalidParametersException::fromInvalidParameter('classId');
        }
        if ($date === null || trim($date) === '') {
            throw InvalidParametersException::fromInvalidParameter('date');
        }
    }
}
