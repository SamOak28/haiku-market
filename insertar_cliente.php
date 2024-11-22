<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar que todos los campos del formulario se hayan enviado
if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['direccion'], $_POST['telefono'])) {
    // Recibir y limpiar los datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);

    // Validación básica de los campos
    if (!empty($nombre) && !empty($apellidos) && !empty($direccion) && !empty($telefono)) {
        // Usar una consulta preparada para evitar inyecciones SQL
        $stmt = $conexion->prepare("INSERT INTO clientes (nombre, apellidos, direccion, telefono) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellidos, $direccion, $telefono);  // "ssss" indica que todos son strings

        if ($stmt->execute()) {
            echo "Cliente registrado exitosamente<br><br>";
        } else {
            echo "Error al registrar el cliente: " . $conexion->error;
        }

        // Cerrar la sentencia preparada
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.<br><br>";
    }
}

// Mostrar todos los registros de clientes
$sql_select = "SELECT * FROM clientes";
$result = $conexion->query($sql_select);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['nombre']) . "</td>
                <td>" . htmlspecialchars($row['apellidos']) . "</td>
                <td>" . htmlspecialchars($row['direccion']) . "</td>
                <td>" . htmlspecialchars($row['telefono']) . "</td>
                <td>
                    <a href='editar_cliente.php?id=" . htmlspecialchars($row['id']) . "'>Editar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay clientes registrados.";
}

// Cerrar la conexión
$conexion->close();
?>
