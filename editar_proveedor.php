<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el ID del proveedor a editar
$id = $_GET['id'];

// Obtener los datos actuales del proveedor
$sql = "SELECT * FROM proveedores WHERE id='$id'";
$result = $conexion->query($sql);
$proveedor = $result->fetch_assoc();
?>

<form action="actualizar_proveedor.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $proveedor['id']; ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $proveedor['nombre']; ?>" required><br>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo $proveedor['apellidos']; ?>" required><br>
    
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $proveedor['direccion']; ?>" required><br>
    
    <label for="provincia">Provincia:</label>
    <input type="text" name="provincia" value="<?php echo $proveedor['provincia']; ?>" required><br>
    
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $proveedor['telefono']; ?>" required><br>
    
    <input type="submit" value="Actualizar Proveedor">
</form>

<?php
$conexion->close();
?>
