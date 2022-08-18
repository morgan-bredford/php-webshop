<?php

declare(strict_types=1);

namespace Src\Exceptions;

class PageNotFoundException extends \Exception
{
    public $message = 'Page not found';
}
