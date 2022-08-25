<?php

declare(strict_types=1);

namespace Src\Enums;

use Src\Controllers\DBController;
use Src\Controllers\UserController;
use Test;

enum RoutesEnum: string
{
    case HOME = '/';
    case SIGNUP = '/signup';
    case LOGIN = '/login';
    case CATEGORY_PRODUCTS = '/category_products';
    case PRODUCT_PAGE = '/product';
    case SEARCH_PAGE = '/search';
    case USERPAGE = '/userpage';
    case TEST = '/test';

    //Returns an array with the class and method to be run for a given path
    public function getRouteCallback(): array
    {
        return match ($this) {
            RoutesEnum::HOME => [DBController::class, 'home'],
            RoutesEnum::SIGNUP => [UserController::class, 'signup'],
            RoutesEnum::LOGIN => [UserController::class, 'login'],
            RoutesEnum::CATEGORY_PRODUCTS => [DBController::class, 'getCategoryProducts'],
            RoutesEnum::PRODUCT_PAGE => [DBController::class, 'createProductPage'],
            RoutesEnum::SEARCH_PAGE => [DBController::class, 'searchProducts'],
            RoutesEnum::USERPAGE => [UserController::class, 'userpage'],
            RoutesEnum::TEST => [Test::class, 'testing'],
            default => ['errorMessage' => 'page not found']
        };
    }
}
