<?php

declare(strict_types=1);

namespace Src;

use Src\Enums\RoutesEnum;
use Src\Controllers\ViewController;

class Router
{
    //Recieves the requested path
    public function resolve(string $path): void
    {
        //Checks if the path recieved exists in the enum for valid paths. If not, then sends the page not found page to the view renderer
        if (RoutesEnum::tryFrom($path)) {
            //Creates an enum object corresponding to the path
            $enumPath = RoutesEnum::from($path);
            //Gets the class and callback for that path
            [$class, $method] = $enumPath->getRouteCallback();
            $class = new $class();
            //Calls the callback method for the path
            call_user_func([$class, $method]);
            //Change the home path '/' to 'home' because the view file is named 'home.php'
            if ($path === '/') $path = 'home';
            $view = new ViewController($path);
            //Calls the view controller to render the view
            $view->constructView();
        } else {
            $view = new ViewController('_404');
            $view->constructView();
        }
    }
}
