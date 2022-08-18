<?php

declare(strict_types=1);
// require_once('./src/Router.php');
// require_once('./src/App.php');


// spl_autoload_register(
//     function ($class) {
//         $path = __DIR__ . '/' . lcfirst(str_replace('\\', '/', $class) . '.php');
//         if (file_exists($path)) {
//             require $path;
//         }
//     }
// );

use Src\App;
use Src\Router;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();

$app = new App($router);
// foreach ($_SERVER as $key => $value) {
//     echo "$key => $value<br>";
// }
echo $_SERVER['REQUEST_URI'];
exit;
$app->run();
