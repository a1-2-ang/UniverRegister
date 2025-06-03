<?php
session_start();
include "conexion.php"; // archivo donde conectas con la base de datos

$usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

// Consulta para obtener usuario
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $fila = $result->fetch_assoc();
    
    // Verifica contraseña
    if (password_verify($contrasena, $fila['contrasena'])) {
        $_SESSION['usuario'] = $usuario;

        // Redirecciona a tu página principal (por ejemplo: index.php)
        header("Location: Index.html");
        exit();
    } else {
        echo "⚠️ Contraseña incorrecta.";
    }
} else {
    echo "⚠️ Usuario no encontrado.";
}
?>