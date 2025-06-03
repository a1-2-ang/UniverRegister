<?php
$conexion = new mysqli("localhost", "root", "", "inventario");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

$sql = "SELECT Nombre AS NOMBRE, Codigo AS CODIGO, Fecha AS FECHA, NumeroDeUsos AS CANTIDAD FROM INVENTARY WHERE Codigo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta por Herramienta</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="grids.css?=v1.2">
    <link rel="stylesheet" href="estilos.css?=v1.2">
</head>
<body>

<div class="container mt-5" id="registro">
    <h2 class="mb-4 text-center">Resultado de Búsqueda</h2>

    <?php if ($codigo === ''): ?>
        <div class="alert alert-warning text-center">
            No se proporcionó ningún código para buscar.
        </div>
    <?php elseif ($resultado->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['NOMBRE']) ?></td>
                            <td><?= htmlspecialchars($fila['CODIGO']) ?></td>
                            <td><?= htmlspecialchars($fila['FECHA']) ?></td>
                            <td><?= htmlspecialchars($fila['CANTIDAD']) ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center">
            No se encontró ninguna herramienta con el código <strong><?= htmlspecialchars($codigo) ?></strong>.
        </div>
    <?php endif; ?>
<a href="consulta.html" class="botones"><button>← Volver</button></a>
</div>
</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>