<?php

declare(strict_types=1);

namespace Src\Enums;

use Src\Controllers\DBController;
use Src\Controllers\UserController;

class RoutesEnum
{
    public $patharray = [
        'HOME' => '/',
        'SIGNUP' => '/signup',
        'LOGIN' => '/login',
        'CATEGORY_PRODUCTS' => '/category_products',
        'PRODUCT_PAGE' => '/product',
        'SEARCH_PAGE' => '/search',
        'USERPAGE' => '/userpage',
        'TEST' => '/test'
    ];

    public function __construct(private string $path)
    {
    }

    public function pathExists(): bool
    {
        return in_array($this->path, $this->patharray, true);
    }


    public function getRouteCallback(): array
    {
        switch (array_search($this->path, $this->patharray, true)) {
            case 'HOME':
                return [DBController::class, 'home'];
                break;
            case 'SIGNUP':
                return [UserController::class, 'signup'];
                break;
            case 'LOGIN':
                return [UserController::class, 'login'];
                break;
            case 'CATEGORY_PRODUCTS':
                return [DBController::class, 'getCategoryProducts'];
                break;
            case 'PRODUCT_PAGE':
                return [DBController::class, 'createProductPage'];
                break;
            case 'SEARCH_PAGE':
                return [DBController::class, 'searchProducts'];
                break;
            case 'USERPAGE':
                return  [UserController::class, 'userpage'];
                break;

            default:
                return ['errorMessage' => 'page not found'];
                break;
        }
    }
}
