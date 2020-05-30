<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebFeletesDevelopers\Kazoku\Controller\NoticiaController;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\NoticiaModel;

/**
 * Class HomeAction.
 * This class will generate the home.
 * @package WebFeletesDevelopers\Kazoku\Action
 */
class newUserAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {

        $body = $response->getBody();
        //$compiledTwig = $this->render('home');
        $compiledTwig = $this->render('newUser',['title' => "titulo",'userName' => "Alberto",'title' => "titulo",'userId' => 0]);
        $body->write($compiledTwig);
        return $response;
    }
}
