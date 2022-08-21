<?php

declare(strict_types=1);

namespace Src\Models;

class Product
{
    public function __construct(
        private int $id,
        private string $name,
        private string $category,
        private string $seller,
        private string $image,
        private float $price,
        private int $quantity,
        private string $description
    ) {
    }
}
