<?php

declare(strict_types=1);

namespace App\Controllers;

class Home
{
    public static function index(): string
    {
        header("Content-Type: text/plain");
        return 'Home of HomeController';
    }
}
