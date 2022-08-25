<?php

declare(strict_types=1);

namespace Src\Controllers;

class DBController
{
    static \PDO $dbConnection;

    public function __construct()
    {
        try {
            self::$dbConnection = new \PDO("mysql:host=$_ENV[DB_HOST];dbname=$_ENV[DB_DATABASE]", "$_ENV[DB_USER]", "$_ENV[DB_PASS]");
        } catch (\PDOException $e) {
            //Renders a 'no connection to database' page if database connection fails
            $viewController = new ViewController('no_db_connection');
            $viewController->constructView();
            exit;
        }
    }

    //Retrieves a user from the database by registered email
    public function getUser(string $email): array
    {
        $query = 'SELECT * FROM wbusers WHERE email = ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    //Search products from user input in the search box
    public function searchProducts(): void
    {
        //Sets a default searchstring if none is found in the request
        $search = $_GET['searchString'] ?? 'noSearchValue';
        $searchString = '%' . $search . '%';
        $query = 'SELECT * FROM wbproducts WHERE name LIKE ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$searchString]);
        $_SESSION['searchProducts'] = $stmt->fetchAll();
    }

    //Retrieves a product from the database by id
    public function getProduct(int|string $id): array
    {
        $query = 'SELECT * FROM wbproducts WHERE id = ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        return $product;
    }

    //Searches for all products with a certain category specified in the request
    public function getCategoryProducts(): void
    {
        //Sets a default searchstring if none is found in the request
        /* NOTE: Make a 'category not found page' */
        $category = $_GET['category'] ?? 'frukt';
        $query = 'SELECT * FROM wbproducts WHERE category = ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$category]);
        $_SESSION['category'] = $stmt->fetchAll();
    }

    //Searches for products that share category with the product selected for the product page
    private function getRelatedProducts(string $category): array
    {
        $query = 'SELECT * FROM wbproducts WHERE category = ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }

    //Searches for products that share seller with the product selected for the product page
    private function getSellerProducts(string $seller): array
    {
        $query = 'SELECT * FROM wbproducts WHERE seller = ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$seller]);
        return $stmt->fetchAll();
    }

    //Makes database requests for the content to be displayed on the product page of the selected product
    public function createProductPage(): void
    {
        $id = $_GET['id'];
        $_SESSION['product'] = $this->getProduct(id: $id);
        $_SESSION['related_products'] = $this->getRelatedProducts(category: $_SESSION['product']['category']);
        $_SESSION['seller_products'] = $this->getSellerProducts(seller: $_SESSION['product']['seller']);
    }

    //Registers a new user in the database
    public function addUser(string $email, string $password, string $firstname, string $lastname): array
    {
        $query = 'INSERT INTO wbusers (email, password, firstname, lastname) VALUES(?, ?, ?, ?)';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$email, $password, $firstname, $lastname]);
        //Request for what id the added user was given
        $query2 = 'SELECT LAST_INSERT_ID() as id';
        $stmt2 = self::$dbConnection->query($query2);
        $id = $stmt2->fetch()['id'];
        return ['id' => $id, 'email' => $email, 'firstname' => $firstname, 'lastname' => $lastname];
    }

    //Updates the information of a user in the database
    public function update(array $user): void
    {
        $query = 'UPDATE wbusers SET email = ?, firstname = ?, lastname = ? WHERE id = ?';
        $stmt = self::$dbConnection->prepare($query);
        $stmt->execute([$user['email'], $user['firstname'], $user['lastname'], $user['id']]);
    }

    //Gets a random product to be displayed on the home page
    public function home(): void
    {
        $id = rand(1, 34);
        $_SESSION['product'] = $this->getProduct(id: $id);
    }
}
