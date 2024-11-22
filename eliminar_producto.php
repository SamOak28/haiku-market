<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el código del producto
$codigoP = $_POST['codigoP'];

// Eliminar el producto de la base de datos
$sql = "DELETE FROM producto WHERE codigoP='$codigoP'";

if ($conexion->query($sql) === TRUE) {
    echo "Producto eliminado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
