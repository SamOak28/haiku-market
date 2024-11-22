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
$telefono = $_POST['telefono'];

// Actualizar los datos del cliente
$sql = "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion', telefono='$telefono' WHERE id='$id'";

if ($conexion->query($sql) === TRUE) {
    echo "Cliente actualizado exitosamente<br><br>";
    echo "<a href='insertar_cliente.php'>Volver a la lista de clientes</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
