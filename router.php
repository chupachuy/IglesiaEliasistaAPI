<?php

require_once 'db.php';

setHeaders();

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? '';
$id = $_GET['id'] ?? null;

$db = Database::getInstance();
$conn = $db->getConnection();

$allowedTables = [
    'coros' => 'coros',
    'devocionarios' => 'devocionarios',
    'dulia' => 'dulia',
    'gacetas' => 'gacetas',
    'hiperdulia' => 'hiperdulia',
    'latria' => 'latria',
    'predicas' => 'predicas',
    'eventos' => 'eventos',
    'oraciones' => 'oraciones'
];

$endpoint = strtolower($endpoint);

if (!isset($allowedTables[$endpoint])) {
    echo json_encode([
        "success" => 0, 
        "message" => "Endpoint no válido. Endpoints disponibles: " . implode(', ', array_keys($allowedTables))
    ]);
    exit;
}

$table = $allowedTables[$endpoint];

switch ($method) {
    case 'GET':
        $data = $db->fetchAll($table, $id);
        
        if (empty($data)) {
            echo json_encode([
                "success" => 0, 
                "message" => $id ? "No se encontró registro con ID $id" : "No hay datos disponibles"
            ]);
        } else {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        
        if (!$input) {
            echo json_encode(["success" => 0, "error" => "Datos inválidos"]);
            break;
        }
        
        $columns = implode(', ', array_keys($input));
        $values = "'" . implode("', '", array_map([$conn, 'real_escape_string'], array_values($input))) . "'";
        
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        
        if ($db->query($sql)) {
            echo json_encode(["success" => 1, "id" => $conn->insert_id]);
        }
        break;

    case 'PUT':
        if (!$id) {
            echo json_encode(["success" => 0, "error" => "ID requerido"]);
            break;
        }
        
        $input = json_decode(file_get_contents("php://input"), true);
        
        if (!$input) {
            echo json_encode(["success" => 0, "error" => "Datos inválidos"]);
            break;
        }
        
        $sets = [];
        foreach ($input as $key => $value) {
            $sets[] = "$key = '" . $conn->real_escape_string($value) . "'";
        }
        
        $sql = "UPDATE $table SET " . implode(', ', $sets) . " WHERE id = " . intval($id);
        
        if ($db->query($sql)) {
            echo json_encode(["success" => 1, "message" => "Registro actualizado"]);
        }
        break;

    case 'DELETE':
        if (!$id) {
            echo json_encode(["success" => 0, "error" => "ID requerido"]);
            break;
        }
        
        $sql = "DELETE FROM $table WHERE id = " . intval($id);
        
        if ($db->query($sql)) {
            echo json_encode(["success" => 1, "message" => "Registro eliminado"]);
        }
        break;

    default:
        echo json_encode(["success" => 0, "error" => "Método no permitido"]);
}
