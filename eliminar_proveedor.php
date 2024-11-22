<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el ID del proveedor a eliminar
$id = $_GET['id'];

// Eliminar el proveedor de la base de datos
$sql = "DELETE FROM proveedores WHERE id='$id'";

if ($conexion->query($sql) === TRUE) {
    echo "Proveedor eliminado exitosamente<br><br>";
    echo "<a href='insertar_proveedor.php'>Volver a la lista de proveedores</a>";
} else {
    echo "Error al eliminar el proveedor: " . $conexion->error;
}

$conexion->close();
?>
