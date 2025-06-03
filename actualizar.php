<?php
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$usos = $_POST['usos'];

if (!$codigo || !$nombre || !$fecha || !is_numeric($usos)) {
    echo "<script>alert('Faltan datos válidos.'); history.back();</script>";
    exit;
}

$conn = new mysqli("localhost", "root", "", "inventario");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "UPDATE INVENTARY SET Nombre = ?, Fecha = ?, NumeroDeUsos = ? WHERE Codigo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $nombre, $fecha, $usos, $codigo);

if ($stmt->execute()) {
    echo "<script>alert('Actualización exitosa'); window.location.href='actualizar.html';</script>";
} else {
    echo "<script>alert('Error al actualizar.'); history.back();</script>";
}

$stmt->close();
$conn->close();
