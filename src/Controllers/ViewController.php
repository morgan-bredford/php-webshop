<?php

declare(strict_types=1);

namespace Src\Controllers;

use Src\Exceptions\PageNotFoundException;

class ViewController
{
    public function __construct(private string $viewPath)
    {
    }

    public function constructView(): void
    {
        require_once($GLOBALS['ROOT_PATH'] . '/views/layout/header.php');
        require_once($GLOBALS['ROOT_PATH'] . '/views/layout/navbar.php');
        try {
            if (file_exists($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php')) {
                require_once($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php');
            } else {
                throw new PageNotFoundException();
            }
        } catch (PageNotFoundException $e) {
            require_once($GLOBALS['ROOT_PATH'] . '/views/_404.php');
        }
        require_once($GLOBALS['ROOT_PATH'] . '/views/layout/footer.php');
    }
}
