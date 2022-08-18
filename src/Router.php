<?php

declare(strict_types=1);

namespace Src;

require_once('RoutesEnum.php');

use RoutesEnum;
use Src\Controllers\ViewController;

class Router
{

    public function __construct()
    {
    }

    public function resolve(string $path)
    {
        $routes = new RoutesEnum();
        if ($routes::tryFrom($path)) {
            $view = new ViewController($path);
            $view->renderView();
        }
    }
}
