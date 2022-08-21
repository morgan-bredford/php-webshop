<?php

declare(strict_types=1);

namespace Src;

use Src\Models\User;
use Src\Enums\RoutesEnum;
use Src\Controllers\ViewController;

class Router
{

    public function __construct()
    {
    }

    public function resolve(string $path): void
    {
        if (RoutesEnum::tryFrom($path)) {
            $enumPath = RoutesEnum::from($path);
            [$class, $method] = $enumPath->getRouteCallback();
            $class = new $class();
            call_user_func([$class, $method]);
            if ($path === '/') $path = 'home';
            $view = new ViewController($path);
            $view->constructView();
        } else {
            $view = new ViewController('_404');
            $view->constructView();
        }
    }
}
