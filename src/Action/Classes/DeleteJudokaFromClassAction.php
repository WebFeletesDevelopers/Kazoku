<?php

namespace WebFeletesDevelopers\Kazoku\Action\Classes;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebFeletesDevelopers\Kazoku\Action\ActionInterface;
use WebFeletesDevelopers\Kazoku\Action\BaseJsonAction;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Controller\JudokaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Enum\Rank;
use WebFeletesDevelopers\Kazoku\Model\JudokaModel;

/**
 * Class DeleteClassAction
 * Class for deleting a class
 * @package WebFeletesDevelopers\Kazoku\Action\Classes
 */
class DeleteJudokaFromClassAction extends BaseJsonAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        if (! $this->loggedUser || ! in_array($this->loggedUser->rank(), Rank::TRAINER_RANKS, true)) {
            return $this->withJson($response, [], 403);
        }

        $db = ConnectionHelper::getConnection();
        $model = new JudokaModel($db);
        $controller = new judokaController($model);

        $data = $request->getParsedBody();

        $judokaId = $data['judokaId'];

        try {
            $this->validateParameters($judokaId);
            $controller->deleteFromClass(
                $judokaId
            );
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param string|null $judokaId
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?string $judokaId): void
    {
        if ($judokaId === null || trim($judokaId) === '') {
            throw InvalidParametersException::fromInvalidParameter('judokaId');
        }
    }
}
