<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el ID del cliente a editar
$id = $_GET['id'];

// Obtener los datos actuales del cliente
$sql = "SELECT * FROM clientes WHERE id='$id'";
$result = $conexion->query($sql);
$cliente = $result->fetch_assoc();
?>

<form action="actualizar_cliente.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required><br>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo $cliente['apellidos']; ?>" required><br>
    
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $cliente['direccion']; ?>" required><br>
    
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $cliente['telefono']; ?>" required><br>
    
    <input type="submit" value="Actualizar Cliente">
</form>

<?php
$conexion->close();
?>
