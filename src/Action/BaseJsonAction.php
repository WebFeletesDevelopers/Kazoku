<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use WebFeletesDevelopers\Kazoku\Action\Exception\InvalidParametersException;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class BaseJsonAction
 * Class to ease JSON-responding actions.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
abstract class BaseJsonAction
{
    private const JSON_CONTENT_TYPE = 'application/json';

    protected ?User $loggedUser = null;

    public function __construct() {
        $userModel = new UserModel(ConnectionHelper::getConnection());
        $this->loggedUser = $this->validateUserSession($userModel);
    }

    /**
     * @param ResponseInterface $response
     * @param array $data
     * @param int $status
     * @return ResponseInterface
     */
    protected function withJson(ResponseInterface $response, array $data, int $status = 200): ResponseInterface
    {
        $body = $response->getBody();
        try {
            $payload = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $body->write('{"message": "Error creating data JSON"}');
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', self::JSON_CONTENT_TYPE);
        }

        $body->write($payload);
        return $response
            ->withStatus($status)
            ->withHeader('Content-Type', self::JSON_CONTENT_TYPE);
    }

    /**
     * @param array<string,mixed> $parameters
     * @throws InvalidParametersException
     */
    protected function validateFromArray(array $parameters): void {
        foreach ($parameters as $name => $value) {
            $type = gettype($value);
            if ($type === 'null') {
                throw InvalidParametersException::fromInvalidParameter($name);
            }
            if ($type === 'string' && $value === '') {
                throw InvalidParametersException::fromInvalidParameter($name);
            }
        }
    }
}
