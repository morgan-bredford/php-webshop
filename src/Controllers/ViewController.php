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
        // $layout = file_get_contents($GLOBALS['ROOT_PATH'] . '/views/layout/layout.php');
        // $navbar = file_get_contents($GLOBALS['ROOT_PATH'] . '/views/layout/navbar.php');
        // $mainView = file_get_contents($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php');
        // $finalView = str_replace('{{navbar}}', $navbar, $layout);
        // $finalView = str_replace('{{content}}', $mainView, $finalView);
        // $a = $this->a();
        // $b = $this->b();
        // $finalView = str_replace('{{navbar}}', $b, $a);
        //return $finalView;

        try {
            require_once($GLOBALS['ROOT_PATH'] . '/views/layout/header.php');
            require_once($GLOBALS['ROOT_PATH'] . '/views/layout/navbar.php');
            if (file_exists($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php')) {
                require_once($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php');
            } else {
                throw new PageNotFoundException();
            }
            require_once($GLOBALS['ROOT_PATH'] . '/views/layout/footer.php');
        } catch (PageNotFoundException $e) {
            require_once($GLOBALS['ROOT_PATH'] . '/views/_404.php');
        }
    }

    public function a()
    {
        ob_start();
        include_once($GLOBALS['ROOT_PATH'] . '/views/layout/layout.php');
        return ob_get_clean();
    }
    public function b()
    {
        ob_start();
        include_once($GLOBALS['ROOT_PATH'] . '/views/layout/navbar.php');
        return ob_get_clean();
    }
    public function renderView(): void
    {
        //ob_start();
        $this->constructView();
        //ob_end_flush();
        //echo 'nu är vi här'; //$view;
    }
}
