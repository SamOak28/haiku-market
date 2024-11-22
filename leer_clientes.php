<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los clientes en la base de datos
$sql = "SELECT * FROM cliente";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "Clave: " . $row["codigoC"] . " - Nombre: " . $row["nombre"] . " " . $row["apellidos"] . " - Teléfono: " . $row["telefono"] . "<br>";
    }
} else {
    echo "No hay clientes registrados";
}

$conexion->close();
?>
