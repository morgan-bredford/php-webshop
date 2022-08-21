<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\App;
use Src\Router;

echo 'git';
$router = new Router();

$app = new App($router);

$app->boot();
$app->run();
