<?php

namespace WebFeletesDevelopers\Kazoku;

use Slim\App;
use WebFeletesDevelopers\Kazoku\Action\assistanceAction;
use WebFeletesDevelopers\Kazoku\Action\confirmUserAction;
use WebFeletesDevelopers\Kazoku\Action\HomeAction;
use WebFeletesDevelopers\Kazoku\Action\judokasAction;
use WebFeletesDevelopers\Kazoku\Action\loginAction;
use WebFeletesDevelopers\Kazoku\Action\myClassAction;
use WebFeletesDevelopers\Kazoku\Action\News\CreateNewsAction;
use WebFeletesDevelopers\Kazoku\Action\NewsCreatorAction;
use WebFeletesDevelopers\Kazoku\Action\newUserAction;
use WebFeletesDevelopers\Kazoku\Action\panelAction;
use WebFeletesDevelopers\Kazoku\Action\profileAction;
use WebFeletesDevelopers\Kazoku\Action\PruebaTraduccionAction;
use WebFeletesDevelopers\Kazoku\Action\registerAction;
use WebFeletesDevelopers\Kazoku\Action\userCheckAction;
use WebFeletesDevelopers\Kazoku\Action\verificateAction;
use WebFeletesDevelopers\Kazoku\Action\virtualClassAction;

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

        //news
        $app->post('/news/add', CreateNewsAction::class);

        $app->get('/pruebatraduccion', PruebaTraduccionAction::class);
        $app->get('/profile', profileAction::class);
        $app->get('/judokas', judokasAction::class);
        $app->get('/assistance', assistanceAction::class);
        $app->get('/myClass', myClassAction::class);
        $app->get('/virtualClass', virtualClassAction::class);
        $app->get('/newUser', newUserAction::class);
        $app->get('/panel', panelAction::class);
        $app->get('/login', loginAction::class);
        $app->get('/register', registerAction::class);
        $app->get('/resetPassword', resetPasswordAction::class);
        $app->get('/logout', logoutAction::class);
        $app->get('/newsCreator', NewsCreatorAction::class);
        $app->get('/confirmUser', confirmUserAction::class);
        $app->get('/verificate', verificateAction::class);
        return $app;
    }
}
