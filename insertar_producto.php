<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar que todos los campos se hayan enviado
if (isset($_POST['descripcion'], $_POST['precio'], $_POST['existencias'])) {
    // Recibir y limpiar los datos del formulario
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $existencias = trim($_POST['existencias']);

    // Validación básica de los campos
    if (!empty($descripcion) && is_numeric($precio) && is_numeric($existencias)) {
        // Usar una consulta preparada para evitar inyecciones SQL
        $stmt = $conexion->prepare("INSERT INTO productos (descripcion, precio, existencias) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $descripcion, $precio, $existencias);  // "sdi" indica tipos: string, double, integer

        if ($stmt->execute()) {
            echo "Producto registrado exitosamente<br><br>";
        } else {
            echo "Error al registrar el producto: " . $conexion->error;
        }

        // Cerrar la sentencia preparada
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios y deben ser válidos.<br><br>";
    }
}

// Mostrar todos los registros de productos
$sql_select = "SELECT * FROM productos";
$result = $conexion->query($sql_select);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Existencias</th>
                <th>Acciones</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['descripcion']) . "</td>
                <td>" . htmlspecialchars($row['precio']) . "</td>
                <td>" . htmlspecialchars($row['existencias']) . "</td>
                <td>
                    <a href='editar_producto.php?id=" . htmlspecialchars($row['id']) . "'>Editar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay productos registrados.";
}

// Cerrar la conexión
$conexion->close();
?>
