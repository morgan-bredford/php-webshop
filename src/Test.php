<?php

class Test
{
    public function testing(): void
    {
        $hello = 'hello';
        ob_start();
        include_once '../views/test.php';
        ob_get_clean();
    }
}
