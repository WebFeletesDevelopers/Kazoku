<?php

namespace WebFeletesDevelopers\Kazoku\Action\Judoka;


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
 * Class deleteJudoka
 * Class for delete a Center
 * @package WebFeletesDevelopers\Kazoku\Action\Center
 */
class DeleteJudokaAction extends BaseJsonAction implements ActionInterface
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
        $controller = new JudokaController($model);

        $data = $request->getParsedBody();

        $judokaId = $data['judokaId'];

        try {
            $this->validateParameters($judokaId);
            $controller->deleteJudoka(
                $judokaId
            );
        } catch (Exception $e) {
            $data = ['message' => $e->getMessage()];
            return $this->withJson($response, $data, 500);
        }

        return $this->withJson($response, [], 201);
    }

    /**
     * @param int|null $codJudoka
     * @return void
     * @throws InvalidParametersException
     */
    private function validateParameters(?int $codJudoka): void
    {
        if ($codJudoka === null || $codJudoka === 0) {
            throw InvalidParametersException::fromInvalidParameter('judokaId');
        }
    }
}
