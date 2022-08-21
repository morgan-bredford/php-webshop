<?php

declare(strict_types=1);

namespace Src\Models;

class User
{
    public function __construct(
        public string $email,
        public string $password,
        public string $firstname,
        public string $lastname,
        public string $address,
        public bool $admin,
        public array $cart = []
    ) {
    }
}
