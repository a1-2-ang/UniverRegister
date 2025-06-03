<?php
$host = "localhost";
$usuario = "root";        // usuario por defecto en XAMPP
$contrasena = "";         // contraseña vacía por defecto
$base_de_datos = "inventario"; // cámbialo al nombre real de tu base de datos

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
}
?>
