<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "inventario"); // Cambia este nombre

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL (sin ROW_NUMBER por compatibilidad)
$sql = "SELECT Nombre, Codigo, Fecha, NumeroDeUsos FROM INVENTARY";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta General</title>
    <link rel="stylesheet" type="text/css" href="grids.css?=v1.2">
    <link rel="stylesheet" href="estilos.css?=v1.2">
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 30px auto;
            font-family: Arial;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        caption {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="registro">
        <table>
            <caption>Herramientas Registradas</caption>
            <tr>
                <th>No.</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Fecha</th>
                <th>Uso</th>
            </tr>
            <?php
            if ($resultado && $resultado->num_rows > 0) {
                $contador = 1;
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $contador++ . "</td>";
                    echo "<td>" . htmlspecialchars($fila["Nombre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["Codigo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["Fecha"]) . "</td>";
                    echo "<td>" . $fila["NumeroDeUsos"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron registros</td></tr>";
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </table>
        <div>
            <a href="Index.html" class="botones"><button>← Volver</button></a>
        </div>
    </div>
</body>
</html>