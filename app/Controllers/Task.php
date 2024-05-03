<?php

declare(strict_types=1);

namespace App\Controllers;
/** */

class Task
{
    public static function index(): string {
        header("Content-type: application/json");

        //coneccion BD y verificacion 
        $db = \getDB();
    
        if (!$db) {
            return json_encode(["error" => "No se pudo conectar a la base de datos."]);
        }
    
        try {

            //consulta sql 
            $stmt = $db->query("SELECT id, title, description, done FROM tasks ORDER BY id ASC;
            ");



        
            return json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
        } catch (\PDOException $e) {
            return json_encode(["error" => "Error al recuperar datos: " . $e->getMessage()]);
        }
    }  


    public static function show($id): string {
        header("Content-type: application/json");

        //coneccion BD y verificacion 
        $db = \getDB();
    
        if (!$db) {
            return json_encode(["error" => "No se pudo conectar a la base de datos."]);
        }
    
        try {

            //consulta sql 
            $stmt = $db->query("SELECT id, title, description, done FROM tasks WHERE id = $id");



        
            return json_encode($stmt->fetch(\PDO::FETCH_ASSOC));
        } catch (\PDOException $e) {
            return json_encode(["error" => "Error al recuperar datos: " . $e->getMessage()]);
        }
    }  


    public static function store(): string {
        header("Content-Type: application/json");
        
        // Conexión a BD
        $db = getDB();
        if (!$db) {
            http_response_code(500);
            return json_encode(["error" => "No se pudo conectar a la base de datos."]);
        }
    
        // Lectura y validación de datos de entrada
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['title'], $data['description'], $data['done'])) {
            http_response_code(400);
            return json_encode(['error' => 'Faltan datos necesarios para la creación de la tarea.']);
        }
    
        // Inserción en la base de datos
        try {
            $stmt = $db->prepare("INSERT INTO tasks (title, description, done) VALUES (:title, :description, :done)");
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':done', $data['done']);
            $stmt->execute();
            http_response_code(201);
            return json_encode(["message" => "Tarea creada exitosamente."]);
        } catch (\PDOException $e) {
            http_response_code(500);
            return json_encode(["error" => "Error al insertar tarea: " . $e->getMessage()]);
        }
    }
    
    public static function update($id): string {
      header("Content-Type: application/json");

      //die($id);

      // Conexión a BD
      $db = getDB();
      if (!$db) {
          http_response_code(500);
          return json_encode(["error" => "No se pudo conectar a la base de datos."]);
      }

      // Lectura y validación de datos de entrada
      $data = json_decode(file_get_contents("php://input"), true);
      if (!isset($data['title'], $data['description'], $data['done'])) {
          http_response_code(400);
          return json_encode(['error' => 'Faltan datos necesarios para la actualización de la tarea.']);
      }

      try {
          // Actualización en la base de datos
          $stmt = $db->prepare("UPDATE tasks SET title = :title, description = :description, done = :done WHERE id = :id");
          $stmt->bindParam(':title', $data['title']);
          $stmt->bindParam(':description', $data['description']);
          $stmt->bindParam(':done', $data['done'], \PDO::PARAM_BOOL);
          $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
          $stmt->execute();

          // Verificar si la tarea fue actualizada
          if ($stmt->rowCount() > 0) {
              http_response_code(200);  // OK
              return json_encode(["message" => "Tarea actualizada exitosamente."]);
          } else {
              http_response_code(404);  // Not found
              return json_encode(["error" => "Tarea no encontrada o datos no modificados."]);
          }
        } catch (\PDOException $e) {
            http_response_code(500);  // Internal server error
            return json_encode(["error" => "Error al actualizar tarea: " . $e->getMessage()]);
        }
    }


    public static function delete($id): string {
        header("Content-Type: application/json");
    
        // Conexión a BD
        $db = getDB();
        if (!$db) {
            http_response_code(500);
            return json_encode(["error" => "No se pudo conectar a la base de datos."]);
        }

        try {
            // Prepare the SQL statement using global namespace for PDO
            $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();

            // Verify if the tasks was deleted
            if ($stmt->rowCount() > 0) {
                http_response_code(200);  // OK
                return json_encode(["message" => "Tarea eliminada exitosamente."]);
            } else {
                http_response_code(404);  // Not found
                return json_encode(["error" => "Tarea no encontrada."]);
            }
        } catch (\PDOException $e) {
            http_response_code(500);  // Internal server error
            return json_encode(["error" => "Error al eliminar tarea: " . $e->getMessage()]);
        }
}



























}
