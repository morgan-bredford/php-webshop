<?php

declare(strict_types=1);

namespace Src\Controllers;

use Src\Exceptions\PageNotFoundException;

class ViewController
{
    public function __construct(private string $viewPath)
    {
    }

    //Constructs the view to be rendered to the user
    public function constructView(): void
    {
        require_once($GLOBALS['ROOT_PATH'] . '/views/layout/header.php');
        require_once($GLOBALS['ROOT_PATH'] . '/views/layout/navbar.php');
        //Throws an exception if the file for the view cant be found. 
        try {
            if (file_exists($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php')) {
                require_once($GLOBALS['ROOT_PATH'] . '/views/' . $this->viewPath . '.php');
            } else {
                throw new PageNotFoundException();
            }
        } catch (PageNotFoundException $e) {
            //Render a 'page not found' instead
            require_once($GLOBALS['ROOT_PATH'] . '/views/_404.php');
        }
        require_once($GLOBALS['ROOT_PATH'] . '/views/layout/footer.php');
    }
}
