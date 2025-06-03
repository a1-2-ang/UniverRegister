<?php
$codigo = $_POST['codigo'];

// Conexión a MySQL (ajusta según tu configuración)
$conn = new mysqli("localhost", "root", "", "inventario");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si existe el código antes de eliminar
$verifica = $conn->prepare("SELECT * FROM INVENTARY WHERE Codigo = ?");
$verifica->bind_param("s", $codigo);
$verifica->execute();
$resultado = $verifica->get_result();

if ($resultado->num_rows === 0) {
    echo "<script>alert('No se encontró la herramienta con ese código.'); history.back();</script>";
    exit;
}

// Ejecutar DELETE
$elimina = $conn->prepare("DELETE FROM INVENTARY WHERE Codigo = ?");
$elimina->bind_param("s", $codigo);

if ($elimina->execute()) {
    echo "<script>alert('Herramienta eliminada correctamente.'); window.location.href='eliminar.html';</script>";
} else {
    echo "<script>alert('Error al eliminar la herramienta.'); history.back();</script>";
}

$conn->close();
?>
