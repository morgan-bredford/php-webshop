<?php

declare(strict_types=1);

namespace Src\Controllers;

class ViewController
{
    public function __construct(private string $viewPath)
    {
    }

    public function constructView()
    {
        $layout = file_get_contents(__DIR__ . '/../../layout/layout.php');
        $navbar = file_get_contents(__DIR__ . '/../../layout/navbar.php');
        $view = file_get_contents(__DIR__ . '/../../views/' . $this->viewPath . '.php');
        $renderView = str_replace('{{navbar}}', $navbar, $layout);
        $renderView = str_replace('{{content}}', $view, $renderView);
        return $renderView;
    }

    public function renderView()
    {
        $view = $this->constructView();
        echo $view;
    }
}
