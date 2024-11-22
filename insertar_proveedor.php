<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar que todos los campos se hayan enviado
if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['direccion'], $_POST['provincia'], $_POST['telefono'])) {
    // Recibir los datos del formulario, aplicar una validación básica
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $direccion = trim($_POST['direccion']);
    $provincia = trim($_POST['provincia']);
    $telefono = trim($_POST['telefono']);

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellidos) && !empty($direccion) && !empty($provincia) && !empty($telefono)) {
        // Usar una consulta preparada para evitar inyecciones SQL
        $stmt = $conexion->prepare("INSERT INTO proveedores (nombre, apellidos, direccion, provincia, telefono) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellidos, $direccion, $provincia, $telefono);

        if ($stmt->execute()) {
            echo "Proveedor registrado exitosamente<br><br>";
        } else {
            echo "Error al registrar el proveedor: " . $conexion->error;
        }

        // Cerrar la sentencia preparada
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.<br><br>";
    }
}

// Mostrar todos los registros de proveedores
$sql_select = "SELECT * FROM proveedores";
$result = $conexion->query($sql_select);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Provincia</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['nombre']) . "</td>
                <td>" . htmlspecialchars($row['apellidos']) . "</td>
                <td>" . htmlspecialchars($row['direccion']) . "</td>
                <td>" . htmlspecialchars($row['provincia']) . "</td>
                <td>" . htmlspecialchars($row['telefono']) . "</td>
                <td>
                    <a href='editar_proveedor.php?id=" . htmlspecialchars($row['id']) . "'>Editar</a> | 
                    <a href='eliminar_proveedor.php?id=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('¿Estás seguro de eliminar este proveedor?');\">Eliminar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay proveedores registrados.";
}

// Cerrar la conexión
$conexion->close();
?>
