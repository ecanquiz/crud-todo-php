<?php

function getDB() {
    $dsn = "pgsql:host=localhost; dbname=task_db";
    $user = "postgres";
    $password = "123456";

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        error_log("Error al conectar a la base de datos: " . $e->getMessage());
        return null;
    }
}
