<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el ID del producto a editar
$id = $_GET['id'];

// Obtener los datos actuales del producto
$sql = "SELECT * FROM productos WHERE id='$id'";
$result = $conexion->query($sql);
$producto = $result->fetch_assoc();
?>

<form action="actualizar_producto.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
    
    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required><br>
    
    <label for="precio">Precio:</label>
    <input type="text" name="precio" value="<?php echo $producto['precio']; ?>" required><br>
    
    <label for="existencias">Existencias:</label>
    <input type="text" name="existencias" value="<?php echo $producto['existencias']; ?>" required><br>
    
    <input type="submit" value="Actualizar Producto">
</form>

<?php
$conexion->close();
?>
