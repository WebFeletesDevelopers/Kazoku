<?php

use Slim\Factory\AppFactory;
use WebFeletesDevelopers\Kazoku\Routes;

require __DIR__ . '/../src/vendor/autoload.php';

$app = AppFactory::create();
$app = Routes::registerRoutes($app);
$app->run();
