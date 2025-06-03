<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario";

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$fecha = $_POST['fecha'];
$usos = $_POST['usos'];

// Validar que no esté vacío
if (empty($nombre) || empty($codigo) || empty($fecha) || empty($usos) || $usos == "0") {
    echo "<script>alert('Faltan datos o número de usos no válido.'); history.back();</script>";
    exit;
}

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar si el código ya existe
$verificar = $conn->prepare("SELECT * FROM INVENTARY WHERE Codigo = ?");
$verificar->bind_param("s", $codigo);
$verificar->execute();
$resultado = $verificar->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>alert('El código ya está registrado. Usa uno diferente.'); history.back();</script>";
    exit;
}

// Insertar si es único
$insertar = $conn->prepare("INSERT INTO INVENTARY (Nombre, Codigo, Fecha, NumeroDeUsos) VALUES (?, ?, ?, ?)");
$insertar->bind_param("sssi", $nombre, $codigo, $fecha, $usos);

if ($insertar->execute()) {
    echo "<script>alert('Registro exitoso'); window.location.href='Index.html';</script>";
} else {
    echo "<script>alert('Error al registrar.'); history.back();</script>";
}
?>
