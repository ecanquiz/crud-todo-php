<?php

declare(strict_types=1);

namespace App\Controllers;

class Task
{
    public static function index(): string
    {
        return 'Home of TaskController';
    }
    
    public static function create(): string
    {
        return 'Create of TaskController';
    }
    
    public static function show(): string
    {
        return 'Show of TaskController';
    }
}
