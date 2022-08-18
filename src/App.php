<?php

declare(strict_types=1);

namespace Src;

class App
{
    public function __construct(private Router $router)
    {
    }

    public function run()
    {
        $route = explode('?', $_SERVER['REQUEST_URI'])[0];
        echo $route;
        $this->router->resolve($route);
    }
}
