<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\App;
use Src\Router;

$router = new Router();

$app = new App($router);

//Run settings before starting main application
$app->boot();
//Start the application
$app->run();
