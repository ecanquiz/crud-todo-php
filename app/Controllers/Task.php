<?php

declare(strict_types=1);

namespace App\Controllers;

class Task
{
    public static function index(): string
    {
        //return 'Index of TaskController';
        return json_encode([
          ["title" => "Title task one"  , "description" => "Description task one"  , "done" => "2024-01-01"],
          ["title" => "Title task two"  , "description" => "Description task two"  , "done" => "2024-01-02"],
          ["title" => "Title task three", "description" => "Description task three", "done" => "2024-01-03"]         
        ]);
        
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
