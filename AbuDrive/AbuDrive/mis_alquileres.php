<?php
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header("location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis alquileres - AbuDrive</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="imagenes/logonegro.png" alt="Logo de AbuDrive">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="alquiler.php">Alquilar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mis_alquileres.php">Mis alquileres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Mis alquileres</h1>
    <hr>

        <div class="row">
            <div class="col-md-12 justify-content-center">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "AbuDrive";

                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT a.*, c.marca, c.modelo, a.precio_final, c.imagen FROM alquileres a JOIN coches c ON a.id_coche = c.id_coche WHERE id_usuario = " . $_SESSION['usuario_id'];
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="confirmation-details">';
                    echo '<ul>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="alquiler">';
                        echo '<div class="car-details">';
                        echo '<h4>' . $row['marca'] . ' ' . $row['modelo'] . '</h4>';
                        echo '<p><strong>Fecha de inicio:</strong> ' . $row['fecha_inicio'] . '</p>';
                        echo '<p><strong>Fecha de fin:</strong> ' . $row['fecha_fin'] . '</p>';
                        echo '<p><strong>Precio:</strong> ' . $row['precio_final'] . '€</p>';
                        echo '</div>';
                        echo '<div class="car-image">';
                        echo '<img src="imagenes/' . $row['imagen'] . '" alt="' . $row['marca'] . ' ' . $row['modelo'] . '" style="max-width: 200px;">';
                        echo '</div>';
                        echo '</div>';
                        echo '<hr>';
                    }


                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '<p>Aún no has realizado ningún alquiler.</p>';
                }

                mysqli_close($conn);
            ?>
            </div>
        </div>

        <div class="button-container d-flex justify-content-center">
            <button class="btn btn-primary" onclick="window.history.back();">Volver</button>
        </div>
        </div>
    </body>
</html>