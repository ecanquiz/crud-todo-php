<?php

declare(strict_types=1);

namespace App\Controllers;

class Task
{
    public static function index(): string {
        header("Content-type: application/json");
        $db = \getDB(); // Asegúrate de usar el backslash si getDB() está en el espacio de nombres global

        if (!$db) {
            return json_encode(["error" => "No se pudo conectar a la base de datos."]);
        }

        try {
            $stmt = $db->query("SELECT title, description FROM task");
            $tasks = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($tasks);
        } catch (\PDOException $e) {
            return json_encode(["error" => "Error al recuperar datos: " . $e->getMessage()]);
        }
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
