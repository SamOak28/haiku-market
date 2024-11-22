<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir los datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$provincia = $_POST['provincia'];
$telefono = $_POST['telefono'];

// Actualizar los datos del proveedor
$sql = "UPDATE proveedores SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion', provincia='$provincia', telefono='$telefono' WHERE id='$id'";

if ($conexion->query($sql) === TRUE) {
    echo "Proveedor actualizado exitosamente<br><br>";
    echo "<a href='insertar_proveedor.php'>Volver a la lista de proveedores</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
