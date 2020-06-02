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
class verificateAction extends BaseTwigAction implements ActionInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {

        setlocale(LC_ALL, 'en_US.UTF-8');
        bindtextdomain('kazoku', __DIR__ . '/../locale');
        textdomain('kazoku');
        $body = $response->getBody();
        //$compiledTwig = $this->render('home');
        $compiledTwig = $this->render('verificate');
        $body->write($compiledTwig);
        return $response;
    }
}
