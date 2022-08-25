<?php

declare(strict_types=1);

namespace Src;

use Src\Controllers\DBController;

class App
{
    public function __construct(private Router $router)
    {
    }

    public function boot(): void
    {
        //Start the session
        session_start();

        //Setup for the .env file
        $dotenv = \Dotenv\Dotenv::createMutable(dirname(__DIR__));
        $dotenv->load();

        //Set the root path so its available globally
        $GLOBALS['ROOT_PATH'] = dirname(__DIR__);

        //Check if cart is set. If not then set it so user can add products to it
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

        //Checks if command to empty the cart has been sent
        /* NOTE: move this somewhere else */
        if (isset($_POST['emptyCart'])) {
            //Removes any addToCart request sent so it's not added after emptying the cart
            unset($_GET['addToCart']);
            //Resets the cart to be empty
            $_SESSION['cart'] = [];
        }

        //Checks if command to remove an item from the cart has been sent
        /* NOTE: move this somewhere else */
        if (isset($_POST['removeItem'])) {
            //Removes any addToCart request sent so it's not added after removing the item
            unset($_GET['addToCart']);
            //Gets the id of the item that is to be removed
            $id = intval($_POST['removeItem']);
            //Removes the item from the cart by id
            unset($_SESSION['cart'][$id]);
        }

        //Checks if addToCart was sent in the request. If it is then call addToCart() with the id from the request
        if (isset($_GET['addToCart'])) $this->addToCart(id: $_GET['addToCart']);
    }

    //Add an item to the cart in the session and in the cookie
    public function addToCart(int|string $id): void
    {
        $dbController = new DBController();
        //Makes a database request for the product to be added to the cart
        $product = $dbController->getProduct($id);
        array_push($_SESSION['cart'], $product);
        //Checks if the user is logged in. If so then adds the product to the cart in the users cookie
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
