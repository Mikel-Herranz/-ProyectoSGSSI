<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Coche</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #444;
            padding: 20px;
            background-color: #fff;
            margin: 0;
            border-bottom: 2px solid #ddd;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 2px solid #ddd;
            margin-top: 20px;
        }

        footer p {
            margin: 0;
            color: #777;
        }

        nav {
            text-align: center;
            background-color: #f8f9fa;
            padding: 15px 0;
            border-top: 2px solid #ddd;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            padding: 10px 20px;
            background-color: #0069d9; /* Color del botón */
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #0056b3; /* Color del botón al pasar el ratón */
        }
    </style>
    <script src="comprobaciones.js"></script>
</head>
<body>
    <h1>Agregar Coche</h1>
    <div class="container">
        <?php
        include 'db.php';  // Conectar a la base de datos

        // Inicializar variables para el formulario
        $nMatricula = '';
        $marcamodelo = '';
        $color = '';
        $kms = '';
        $cv = '';
        $anio = '';

        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtén los valores del formulario
            $nMatricula = $_POST['nMatricula'];
            $marcamodelo = $_POST['marcamodelo'];
            $color = $_POST['color'];
            $kms = $_POST['kms'];
            $cv = $_POST['cv'];
            $anio = $_POST['anio'];

            // Ejecuta la consulta de inserción
            $query = "INSERT INTO coches (matricula, marca_modelo, color, kilometros, CV, año) VALUES ('$nMatricula', '$marcamodelo', '$color', '$kms', '$cv', '$anio')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Mensaje de éxito
                 echo "<p style='color: green;'>Coche añadido correctamente.</p>";
            } else {
                // Muestra un mensaje de error
                if ($conn->errno === 1062) {
                    $error_message = 'La matrícula ya está registrada, prueba con otra.';
                } else {
                    $error_message = 'Error, prueba con otros datos.';
                }
            }
        }

        // Mostrar mensaje de error si existe
        if ($error_message) {
            echo "<p style='color: red;'>$error_message</p>";
        }

        // Formulario para agregar nuevos datos
        echo '<form id="item_add_form" action="add_item.php" method="post">';
        echo '<label for="nMatricula">Matrícula:</label>';
        echo '<input type="text" id="nMatricula" name="nMatricula" value="' . htmlspecialchars($nMatricula) . '" required>';
        echo '<label for="marcamodelo">Marca y modelo:</label>';
        echo '<input type="text" id="marcamodelo" name="marcamodelo" value="' . htmlspecialchars($marcamodelo) . '" required>';
        echo '<label for="color">Color:</label>';
        echo '<input type="text" id="color" name="color" value="' . htmlspecialchars($color) . '" required>';
        echo '<label for="kms">Kilómetros:</label>';
        echo '<input type="text" id="kms" name="kms" value="' . htmlspecialchars($kms) . '" required>';
        echo '<label for="cv">Caballos:</label>';
        echo '<input type="text" id="cv" name="cv" value="' . htmlspecialchars($cv) . '" required>';
        echo '<label for="anio">Año:</label>';
        echo '<input type="text" id="anio" name="anio" value="' . htmlspecialchars($anio) . '" required>';
        echo '<button id="item_add_submit" name="item_add_submit" type="submit">Agregar Coche</button>';
        echo '</form>';
        ?>
    </div>

    <nav>
        <a href="index.php">Inicio</a> <!-- Este es el botón que has solicitado cambiar -->
    </nav>

    <footer>
        <p>&copy; 2024 Página de Coches. Todos los derechos reservados.</p>
    </footer>
    
</body>
</html>

