<?php

class Database {
    private static $instance = null;
    private $connection;

    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasenia = "";
    private $nombreBaseDatos = "iglesiae_ApIApp2024";

    private function __construct() {
        $this->connection = new mysqli(
            $this->servidor, 
            $this->usuario, 
            $this->contrasenia, 
            $this->nombreBaseDatos
        );
        $this->connection->set_charset("utf8");

        if ($this->connection->connect_error) {
            http_response_code(500);
            die(json_encode(["success" => 0, "error" => "Error de conexión: " . $this->connection->connect_error]));
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        if (!$result) {
            http_response_code(400);
            die(json_encode(["success" => 0, "error" => "Error SQL: " . mysqli_error($this->connection)]));
        }
        return $result;
    }

    public function fetchAll($table, $id = null) {
        if ($id !== null) {
            $sql = "SELECT * FROM $table WHERE id = " . intval($id);
        } else {
            $sql = "SELECT * FROM $table";
        }
        
        $result = $this->query($sql);
        
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }
}

function setHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}
