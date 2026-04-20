<?php

require_once 'db.php';

$db = Database::getInstance();
$conn = $db->getConnection();

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100),
    rol ENUM('admin','editor','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Tabla 'usuarios' creada exitosamente<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

$email = "jesuslv2412@hotmail.com";
$password = password_hash("123", PASSWORD_DEFAULT);
$nombre = "Jesus";

$stmt = $conn->prepare("INSERT IGNORE INTO usuarios (email, password, nombre) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $password, $nombre);

if ($stmt->execute()) {
    echo "Usuario creado exitosamente<br>";
    echo "Email: $email<br>";
    echo "Password (hash): $password";
} else {
    echo "Error: " . $stmt->error;
}

$email2 = "fa_arenita@hotmail.com";
$password2 = password_hash("aremintaIglesiaeditor", PASSWORD_DEFAULT);
$nombre2 = "Arenita";

$stmt2 = $conn->prepare("INSERT IGNORE INTO usuarios (email, password, nombre) VALUES (?, ?, ?)");
$stmt2->bind_param("sss", $email2, $password2, $nombre2);

if ($stmt2->execute()) {
    echo "<br>Usuario creado exitosamente<br>";
    echo "Email: $email2<br>";
    echo "Password (hash): $password2";
} else {
    echo "Error: " . $stmt2->error;
}
