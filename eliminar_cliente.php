<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el código del cliente
$codigoC = $_POST['codigoC'];

// Eliminar el cliente de la base de datos
$sql = "DELETE FROM cliente WHERE codigoC='$codigoC'";

if ($conexion->query($sql) === TRUE) {
    echo "Cliente eliminado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
