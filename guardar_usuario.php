<?php
include "conexion.php";

$nombre = $_POST['nombre_usuario'];
$password = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Preparar y ejecutar el INSERT
$stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)");
$stmt->bind_param("ss", $nombre, $password);

try {
    $stmt->execute();
    
    // Redirigir al login después del registro
    header("Location: login.html");
    exit();
} catch (mysqli_sql_exception $e) {
    echo "Error al registrar: " . $e->getMessage();
}

$stmt->close();
$conn->close();
?>
