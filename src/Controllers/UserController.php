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

    private function loggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public function logout(): void
    {
        $_SESSION = array();
        session_destroy();
    }

    public function userpage(): void
    {
        if (!$this->loggedIn()) {
            header('Location: /');
            exit;
        }

        if (isset($_POST['logout'])) {
            $this->logout();
            header('Location: /');
            exit;
        }

        if (isset($_POST['update'])) {
            $user = $_POST;
            $user['id'] = $_SESSION['user']['id'];
            $this->dbController->update(user: $user);
            $_SESSION['user'] = [$_SESSION['user'], ...$user];
        }
    }

    public function signup(): void
    {

        if ($this->loggedIn()) {
            header('Location: /');
            exit;
        }

        if (!empty($_POST)) {
            extract($_POST, EXTR_SKIP);
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            $user = $this->dbController->addUser(
                email: $email,
                password: $hashpassword,
                firstname: $firstname,
                lastname: $lastname
            );
            $this->setActiveUser(user: $user);
            header('Location: /');
        }
    }
}
