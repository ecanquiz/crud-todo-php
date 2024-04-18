<?php

declare(strict_types=1);

namespace App\Controllers;

class Task
{
    public static function index(): string
    {
        return 'Index of TaskController';
    }   
   
    //public static function show(): string
    //{
    //    return 'Show of TaskController';
    //}

    public static function store()// : string
    {
        $amount = $_POST['amount'];
        $entityBody = file_get_contents('php://input');
        //return var_dump($_POST);
        return $entityBody;
    }
}
