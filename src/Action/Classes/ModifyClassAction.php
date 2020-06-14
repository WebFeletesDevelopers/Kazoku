<?php

namespace WebFeletesDevelopers\Kazoku\Action\Classes;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\ClaseController;
use WebFeletesDevelopers\Kazoku\Model\ClaseModel;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;

/**
 * Class ModifyClassAction
 * Class for modify a class
 * @package WebFeletesDevelopers\Kazoku\Action\Class
 */
class ModifyClassAction extends BaseJsonAction implements ActionInterface
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
        $model = new ClaseModel($db);
        $controller = new ClaseController($model);

        $data = $request->getParsedBody();
        $schedule = $data['schedule'];
        $name = $data['name'];
        $trainer = $data['trainer'];
        $days = $data['days'];
        $minAge = $data['minAge'];
        $maxAge = $data['maxAge'];
        $centerId = $data['centerId'];
        $classId = $data['classId'];

        try {
            $this->validateParameters($name,$schedule,$trainer,$days,$minAge,$maxAge,$centerId);
            $controller->modify(
                $schedule,
                $trainer,
                $minAge,
                $maxAge,
                $name,
                $centerId,
                $days,
                $classId,
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
     * @param string|null $name
     * @param string|null $schedule
     * @param string|null $trainer
     * @param int|null $days
     * @param int|null $minAge
     * @param int|null $maxAge
     * @param int|null $centerId
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $name,
                                        ?string $schedule,
                                        ?string $trainer,
                                        ?int $days,
                                        ?int $minAge,
                                        ?int $maxAge,
                                        ?int $centerId): void
    {
        if ($schedule === null || trim($schedule) === '') {
            throw InvalidParametersException::fromInvalidParameter('schedule');
        }
        if ($name === null || trim($name) === '') {
            throw InvalidParametersException::fromInvalidParameter('name');
        }
        if ($trainer === null || trim($trainer) === '') {
            throw InvalidParametersException::fromInvalidParameter('trainer');
        }
        if ($days === null || $days = 0) {
            throw InvalidParametersException::fromInvalidParameter('days');
        }
        if ($minAge === null || $minAge = 0) {
            throw InvalidParametersException::fromInvalidParameter('minAge');
        }
        if ($maxAge === null || $maxAge = 0) {
            throw InvalidParametersException::fromInvalidParameter('maxAge');
        }
        if ($centerId === null || $centerId = 0) {
            throw InvalidParametersException::fromInvalidParameter('centerId');
        }

    }
}
