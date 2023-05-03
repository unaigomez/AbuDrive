<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AbuDrive - Alquiler de coches</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header("location: login.php");
        exit;
    }
?>

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
                <a class="nav-link" href="logout.php">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">AbuDrive</h1>
    <hr>

    <h2>Coches disponibles:</h2>
    <div class="row">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "AbuDrive";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM coches";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM accesorios";
            $accesorios = mysqli_query($conn, $sql);
            

            while ($coche = mysqli_fetch_assoc($result)) :
        ?>
            <div class="car-card">
                <h3><?php echo $coche["marca"] . " " . $coche["modelo"]; ?></h3>
                <img src="imagenes/<?php echo $coche["imagen"]; ?>" alt="<?php echo $coche["marca"] . " " . $coche["modelo"]; ?>">
                <p>Precio diario: <?php echo $coche["precio_diario"]; ?>€</p>
            </div>

        <?php endwhile; ?>
    </div>

    <section class="accesorios">
        <h2>Accesorios disponibles</h2>
        <div class="row">
            <?php while ($accesorio = mysqli_fetch_assoc($accesorios)) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="accessory-card">
                        <h3><?php echo $accesorio['nombre']; ?></h3>
                        <img src="imagenes/<?php echo $accesorio['imagen']; ?>" alt="<?php echo $accesorio['nombre']; ?>">
                        <p>Precio: <?php echo $accesorio['precio']; ?> €</p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>


    <div class="text-center mt-4">
        <a href="alquiler.php" class="btn btn-primary">Ir a alquilar</a>
    </div>
    <br><br>
</div>

</body>
</html>

