<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los productos en la base de datos
$sql = "SELECT * FROM producto";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "Código: " . $row["codigoP"] . " - Descripción: " . $row["descripcion"] . " - Precio: $" . $row["precio"] . " - Existencias: " . $row["existencias"] . "<br>";
    }
} else {
    echo "No hay productos registrados";
}

$conexion->close();
?>
