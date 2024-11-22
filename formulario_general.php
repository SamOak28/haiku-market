<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Clientes, Productos y Proveedores</title>
    <style>
        /* Estilos básicos para las pestañas */
        .tab {
            display: inline-block;
            margin-right: 10px;
            padding: 10px;
            background-color: lightgray;
            cursor: pointer;
        }
        .active {
            background-color: gray;
            color: white;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
    </style>
    <script>
        // Función para mostrar el formulario correspondiente
        function showForm(formId) {
            // Ocultar todos los formularios
            const sections = document.querySelectorAll('.form-section');
            sections.forEach(section => section.classList.remove('active'));
            
            // Mostrar el formulario seleccionado
            document.getElementById(formId).classList.add('active');

            // Actualizar las pestañas activas
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.getElementById('tab-' + formId).classList.add('active');
        }
    </script>
</head>
<body>
    <h2>Gestión de Clientes, Productos y Proveedores</h2>
    
    <!-- Pestañas para seleccionar el formulario -->
    <div>
        <div id="tab-clientes" class="tab active" onclick="showForm('clientes')">Clientes</div>
        <div id="tab-productos" class="tab" onclick="showForm('productos')">Productos</div>
        <div id="tab-proveedores" class="tab" onclick="showForm('proveedores')">Proveedores</div>
    </div>

    <!-- Formulario para Clientes -->
    <div id="clientes" class="form-section active">
        <h3>Formulario de Clientes</h3>
        <form action="insertar_cliente.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required><br>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required><br>

            <input type="submit" value="Registrar Cliente">
        </form>
        
        <!-- Tabla de Clientes -->
        <h3>Lista de Clientes</h3>
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'tienda');

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Consulta para obtener todos los clientes
        $sql_clientes = "SELECT * FROM clientes";
        $resultado_clientes = $conexion->query($sql_clientes);

        if ($resultado_clientes->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>";
            while ($row = $resultado_clientes->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['nombre'] . "</td>
                        <td>" . $row['apellidos'] . "</td>
                        <td>" . $row['direccion'] . "</td>
                        <td>" . $row['telefono'] . "</td>
                        <td>
                            <a href='editar_cliente.php?id=" . $row['id'] . "'>Editar</a> | 
                            <a href='eliminar_cliente.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de eliminar este cliente?');\">Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay clientes registrados.";
        }
        ?>
    </div>

    <!-- Formulario para Productos -->
    <div id="productos" class="form-section">
        <h3>Formulario de Productos</h3>
        <form action="insertar_producto.php" method="POST">
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" required><br>

            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" required><br>

            <label for="existencias">Existencias:</label>
            <input type="number" name="existencias" required><br>

            <input type="submit" value="Registrar Producto">
        </form>

        <!-- Tabla de Productos -->
        <h3>Lista de Productos</h3>
        <?php
        // Consulta para obtener todos los productos
        $sql_productos = "SELECT * FROM productos";
        $resultado_productos = $conexion->query($sql_productos);

        if ($resultado_productos->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Existencias</th>
                        <th>Acciones</th>
                    </tr>";
            while ($row = $resultado_productos->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['descripcion'] . "</td>
                        <td>" . $row['precio'] . "</td>
                        <td>" . $row['existencias'] . "</td>
                        <td>
                            <a href='editar_producto.php?id=" . $row['id'] . "'>Editar</a> | 
                            <a href='eliminar_producto.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de eliminar este producto?');\">Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay productos registrados.";
        }
        ?>
    </div>

    <!-- Formulario para Proveedores -->
    <div id="proveedores" class="form-section">
        <h3>Formulario de Proveedores</h3>
        <form action="insertar_proveedor.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required><br>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" required><br>

            <label for="provincia">Provincia:</label>
            <input type="text" name="provincia" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required><br>

            <input type="submit" value="Registrar Proveedor">
        </form>

        <!-- Tabla de Proveedores -->
        <h3>Lista de Proveedores</h3>
        <?php
        // Consulta para obtener todos los proveedores
        $sql_proveedores = "SELECT * FROM proveedores";
        $resultado_proveedores = $conexion->query($sql_proveedores);

        if ($resultado_proveedores->num_rows > 0) {
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
            while ($row = $resultado_proveedores->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['nombre'] . "</td>
                        <td>" . $row['apellidos'] . "</td>
                        <td>" . $row['direccion'] . "</td>
                        <td>" . $row['provincia'] . "</td>
                        <td>" . $row['telefono'] . "</td>
                        <td>
                            <a href='editar_proveedor.php?id=" . $row['id'] . "'>Editar</a> | 
                            <a href='eliminar_proveedor.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de eliminar este proveedor?');\">Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay proveedores registrados.";
        }
        
        // Cierra la conexión a la base de datos
        $conexion->close();
        ?>
    </div>
</body>
</html>
