<?php

declare(strict_types=1);

namespace Src\Controllers;

class UserController
{
    private DBController $dbController;

    public function __construct()
    {
        $this->dbController = new DBController();
    }

    public function login(): void
    {
        //Redirect to home page if user is already logged in
        if ($this->loggedIn()) {
            header('Location: /');
            exit;
        }

        if (!empty($_POST)) {
            $email = $_POST['email'];
            $user = $this->dbController->getUser($email);

            if (password_verify($_POST['password'], $user['password'])) {
                $this->setActiveUser(user: $user);
                header('Location: /');
                exit;
            }
        }
    }

    /* Sets the logged in user into the session. Then checks if the user already has a cookie set.
       If yes then set the cart saved in the cookie into the session.
       If no then create the cookie */
    private function setActiveUser(array $user): void
    {
        $_SESSION['user'] = $user;
        $_SESSION['cart'] = [];
        $trimmedEmail = explode('.', $user['email'])[0];
        if (isset($_COOKIE[$trimmedEmail])) {
            $cookieCart = json_decode($_COOKIE[$trimmedEmail], true);
            $_SESSION['cart'] = $cookieCart;
        }
    }

    //Returns true if a user is logged in
    private function loggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    //Destroys the session
    public function logout(): void
    {
        $_SESSION = array();
        session_destroy();
    }

    //Methods for the user page where the user can update their info or log out
    public function userpage(): void
    {
        //Redirects if user is not logged in
        if (!$this->loggedIn()) {
            header('Location: /');
            exit;
        }

        //Logs out the user and redirects to the home page
        if (isset($_POST['logout'])) {
            $this->logout();
            header('Location: /');
            exit;
        }

        //Sends update to the database and updates the session with the changed info from the user
        if (isset($_POST['update'])) {
            $user = $_POST;
            $user['id'] = $_SESSION['user']['id'];
            $this->dbController->update(user: $user);
            $_SESSION['user'] = [$_SESSION['user'], ...$user];
        }
    }

    //Sends request to add a new user to the database
    public function signup(): void
    {

        //Redirects to home page if user is already logged in
        if ($this->loggedIn()) {
            header('Location: /');
            exit;
        }

        if (!empty($_POST)) {
            //Extracts the info submitted by the user
            extract($_POST, EXTR_SKIP);
            //Hashes password for storage
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            $user = $this->dbController->addUser(
                email: $email,
                password: $hashpassword,
                firstname: $firstname,
                lastname: $lastname
            );
            //Sets the user into the session and redirects to the home page
            $this->setActiveUser(user: $user);
            header('Location: /');
        }
    }
}
