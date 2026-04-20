<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iglesiae_apiapp2024"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8");

// Script SQL para actualizar las URLs
$sql = "UPDATE predicas SET url = REPLACE(url, 'predicas/', 'audios/') WHERE url LIKE '%predicas/%'";

if ($conn->query($sql) === TRUE) {
    $affected_rows = $conn->affected_rows;
    echo "✓ Actualización exitosa!<br>";
    echo "Filas actualizadas: " . $affected_rows . "<br>";
} else {
    echo "Error al actualizar: " . $conn->error;
}

$conn->close();
?>