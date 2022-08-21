<?php

declare(strict_types=1);

namespace Src\Controllers;

class DBController
{
    public \PDO $dbConnection;

    public function __construct()
    {
        try {
            $this->dbConnection = new \PDO("mysql:host=$_ENV[DB_HOST];dbname=$_ENV[DB_DATABASE]", "$_ENV[DB_USER]", "$_ENV[DB_PASS]");
        } catch (\PDOException $e) {
            $viewController = new ViewController('no_db_connection');
            $viewController->constructView();
            exit;
        }
    }

    public function getUser(string $email): array
    {
        $query = 'SELECT * FROM wbusers WHERE email = ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchAll()[0];
    }

    public function searchProducts(): void
    {
        if (isset($_GET['searchString'])) $_SESSION['searchString'] = $_GET['searchString'];
        $searchString = '%' . $_SESSION['searchString'] . '%';
        $query = 'SELECT * FROM wbproducts WHERE name LIKE ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$searchString]);
        $_SESSION['searchProducts'] = $stmt->fetchAll();
    }

    public function getProduct(int|string $id): array
    {
        $query = 'SELECT * FROM wbproducts WHERE id = ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        return $product;
    }

    public function getCategoryProducts(): void
    {
        $category = $_GET['category'];
        $query = 'SELECT * FROM wbproducts WHERE category = ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$category]);
        $_SESSION['category'] = $stmt->fetchAll();
    }

    public function getRelatedProducts(string $category): array
    {
        $query = 'SELECT * FROM wbproducts WHERE category = ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }

    public function getSellerProducts(string $seller): array
    {
        $query = 'SELECT * FROM wbproducts WHERE seller = ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$seller]);
        return $stmt->fetchAll();
    }

    public function createProductPage(): void
    {
        $id = $_GET['id'];
        $_SESSION['product'] = $this->getProduct(id: $id);
        $_SESSION['related_products'] = $this->getRelatedProducts(category: $_SESSION['product']['category']);
        $_SESSION['seller_products'] = $this->getSellerProducts(seller: $_SESSION['product']['seller']);
    }

    public function addUser(string $email, string $password, string $firstname, string $lastname): void
    {
        $query = 'INSERT INTO wbusers (email, password, firstname, lastname) VALUES(?, ?, ?, ?)';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$email, $password, $firstname, $lastname]);
        $query2 = 'SELECT LAST_INSERT_ID() as id';
        $stmt2 = $this->dbConnection->query($query2);
        $id = $stmt2->fetch()['id'];
        $user = ['id' => $id, 'email' => $email, 'firstname' => $firstname, 'lastname' => $lastname];
        $userController = new UserController();
        $userController->setActiveUser($user);
    }

    public function update(array $user): void
    {
        $query = 'UPDATE wbusers SET email = ?, firstname = ?, lastname = ? WHERE id = ?';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([$user['email'], $user['firstname'], $user['lastname'], $user['id']]);
    }

    public function home(): void
    {
        $id = rand(1, 34);
        $_SESSION['product'] = $this->getProduct(id: $id);
    }
}
