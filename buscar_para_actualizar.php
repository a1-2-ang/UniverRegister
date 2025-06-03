<?php
if (!isset($_GET['codigo']) || !is_numeric($_GET['codigo'])) {
    echo "<script>alert('Código inválido.'); history.back();</script>";
    exit;
}

$codigo = $_GET['codigo'];

$conn = new mysqli("localhost", "root", "", "inventario");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM INVENTARY WHERE Codigo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('No se encontró la herramienta.'); window.location.href='actualizar.html';</script>";
    exit;
}

$row = $result->fetch_assoc();
?>
<head>
    <link rel="stylesheet" type="text/css" href="grids.css?=v1.2">
    <link rel="stylesheet" href="estilos.css?=v1.2">
</head>
<form method="POST" action="actualizar.php" id="registro">
    <div class="texto">
        <h2>Editar Herramienta</h2>
        <input type="hidden" name="codigo" value="<?= htmlspecialchars($row['Codigo']) ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($row['Nombre']) ?>" required><br><br>

        <label>Fecha:</label><br>
        <input type="date" name="fecha" value="<?= htmlspecialchars($row['Fecha']) ?>" required><br><br>

        <label>Número de articulos:</label><br>
        <input type="number" name="usos" value="<?= htmlspecialchars($row['NumeroDeUsos']) ?>" required><br><br>

    </div>
    <div class="botones">
        <button type="submit">Actualizar</button>
    </div>
    <div>
        <a href="actualizar.html" class="botones"><button type="button">← Volver</button></a>
    </div>
</form>
<br>