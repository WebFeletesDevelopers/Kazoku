<?php

namespace WebFeletesDevelopers\Kazoku;

use Slim\App;
use WebFeletesDevelopers\Kazoku\Action\assistanceAction;
use WebFeletesDevelopers\Kazoku\Action\Center\CreateCenterAction;
use WebFeletesDevelopers\Kazoku\Action\Center\DeleteCenterAction;
use WebFeletesDevelopers\Kazoku\Action\Center\ModifyCenterAction;
use WebFeletesDevelopers\Kazoku\Action\centerAdminAction;
use WebFeletesDevelopers\Kazoku\Action\CenterDetailAction;
use WebFeletesDevelopers\Kazoku\Action\classAdminAction;
use WebFeletesDevelopers\Kazoku\Action\classDetailAction;
use WebFeletesDevelopers\Kazoku\Action\Classes\CreateClassAction;
use WebFeletesDevelopers\Kazoku\Action\Classes\DeleteClassAction;
use WebFeletesDevelopers\Kazoku\Action\Classes\ModifyClassAction;
use WebFeletesDevelopers\Kazoku\Action\confirmUserAction;
use WebFeletesDevelopers\Kazoku\Action\HomeAction;
use WebFeletesDevelopers\Kazoku\Action\judokasAction;
use WebFeletesDevelopers\Kazoku\Action\LoginAction;
use WebFeletesDevelopers\Kazoku\Action\logoutAction;
use WebFeletesDevelopers\Kazoku\Action\myClassAction;
use WebFeletesDevelopers\Kazoku\Action\News\CreateNewsAction;
use WebFeletesDevelopers\Kazoku\Action\News\DeleteNewsAction;
use WebFeletesDevelopers\Kazoku\Action\NewsCreatorAction;
use WebFeletesDevelopers\Kazoku\Action\newUserAction;
use WebFeletesDevelopers\Kazoku\Action\panelAction;
use WebFeletesDevelopers\Kazoku\Action\profileAction;
use WebFeletesDevelopers\Kazoku\Action\PruebaTraduccionAction;
use WebFeletesDevelopers\Kazoku\Action\registerAction;
use WebFeletesDevelopers\Kazoku\Action\resetPasswordAction;
use WebFeletesDevelopers\Kazoku\Action\User\GetLoginHashAction;
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
        $app->get('/Home', HomeAction::class);

        //users
        $app->get('/login', LoginAction::class);
        $app->get('/register', registerAction::class);
        $app->get('/resetPassword', resetPasswordAction::class);
        $app->get('/logout', logoutAction::class);
        $app->get('/confirmUser', confirmUserAction::class);
        $app->get('/verificate', verificateAction::class);
        $app->get('/profile', profileAction::class);
        $app->get('/newUser', newUserAction::class);


        //news
        $app->get('/newsCreator', NewsCreatorAction::class);
        $app->post('/news/add', CreateNewsAction::class);
        $app->post('/news/delete', DeleteNewsAction::class);


        //user
        $app->post('/user/hash/get', GetLoginHashAction::class);

        //class
        $app->get('/classAdmin', classAdminAction::class);
        $app->get('/classDetail/{id}', classDetailAction::class);
        $app->post('/class/add', CreateClassAction::class);
        $app->post('/class/modify', ModifyClassAction::class);
        $app->post('/class/delete', DeleteClassAction::class);

        $app->get('/virtualClass', virtualClassAction::class);
        $app->get('/myClass', myClassAction::class);

        //center
        $app->get('/centerAdmin', centerAdminAction::class);
        $app->post('/center/add', CreateCenterAction::class);
        $app->post('/center/delete', DeleteCenterAction::class);
        $app->get('/centerDetail/{id}', CenterDetailAction::class);
        $app->post('/center/modify', ModifyCenterAction::class);

        $app->get('/pruebatraduccion', PruebaTraduccionAction::class);
        $app->get('/judokas', judokasAction::class);
        $app->get('/assistance', assistanceAction::class);
        $app->get('/panel', panelAction::class);


        return $app;
    }
}
