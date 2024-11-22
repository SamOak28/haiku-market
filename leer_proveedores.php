<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los proveedores en la base de datos
$sql = "SELECT * FROM proveedores";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "Código: " . $row["codigoProv"] . " - Nombre: " . $row["nombre"] . " " . $row["apellidos"] . " - Teléfono: " . $row["telefono"] . "<br>";
    }
} else {
    echo "No hay proveedores registrados";
}

$conexion->close();
?>
