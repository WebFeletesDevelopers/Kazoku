<?php

namespace WebFeletesDevelopers\Kazoku;

use Slim\App;
use WebFeletesDevelopers\Kazoku\Action\HomeAction;
use WebFeletesDevelopers\Kazoku\Action\PruebaTraduccionAction;

/**
 * Class Routes
 * @package WebFeletesDevelopers\Kazoku
 */
class Routes
{
    /**
     * @param App $app
     * @return App
     */
    public static function registerRoutes(App $app): App
    {
        $app->get('/', HomeAction::class);
        $app->get('/pruebatraduccion', PruebaTraduccionAction::class);

        return $app;
    }
}
