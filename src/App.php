<?php

declare(strict_types=1);

namespace Src;

use Src\Controllers\DBController;
use Src\Models\User;

class App
{
    public function __construct(private Router $router)
    {
    }

    public function boot(): void
    {
        session_start();

        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

        $dotenv = \Dotenv\Dotenv::createMutable(dirname(__DIR__));
        $dotenv->load();

        $GLOBALS['ROOT_PATH'] = dirname(__DIR__);


        if (isset($_POST['emptyCart'])) {
            unset($_GET['addToCart']);
            $_SESSION['cart'] = [];
        }

        if (isset($_POST['removeItem'])) {
            unset($_GET['addToCart']);
            $id = intval($_POST['removeItem']);
            unset($_SESSION['cart'][$id]);
        }

        if (isset($_GET['addToCart'])) $this->addToCart(id: $_GET['addToCart']);
    }

    public function addToCart(int|string $id): void
    {
        $dbController = new DBController();
        $product = $dbController->getProduct($id);
        array_push($_SESSION['cart'], $product);
        isset($_SESSION['user'])
            ? setcookie(explode('.', $_SESSION['user']['email'])[0], json_encode($_SESSION['cart']))
            : setcookie('guest', json_encode($_SESSION['cart']));
    }

    public function run(): void
    {
        $route = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->router->resolve($route);
    }
}
