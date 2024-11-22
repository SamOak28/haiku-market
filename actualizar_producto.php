<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir los datos del formulario
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$existencias = $_POST['existencias'];

// Actualizar los datos del producto
$sql = "UPDATE productos SET descripcion='$descripcion', precio='$precio', existencias='$existencias' WHERE id='$id'";

if ($conexion->query($sql) === TRUE) {
    echo "Producto actualizado exitosamente<br><br>";
    echo "<a href='insertar_producto.php'>Volver a la lista de productos</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
