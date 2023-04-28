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
    <h1 class="text-center">Alquiler de coches</h1>
    <hr>

    <h2>Selecciona un coche:</h2>
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
    <div class="accesorios-container">
        <?php while ($accesorio = mysqli_fetch_assoc($accesorios)) : ?>
            <div class="accesorio">
                <img src="<?php echo $accesorio['imagen']; ?>" alt="<?php echo $accesorio['nombre']; ?>">
                <h3><?php echo $accesorio['nombre']; ?></h3>
                <p>Precio: <?php echo $accesorio['precio']; ?> €</p>
                <p>Descripción: <?php echo $accesorio['descripcion']; ?></p>
                <button class="btn-anadir" data-accesorio="<?php echo $accesorio['id_accesorio']; ?>">Añadir</button>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<div class="modal">
    <div class="modal-content">
        <h2>Reserva de coche</h2>
        <form method="post" action="procesar_alquiler.php">
            <input type="hidden" name="id_coche" id="modal_id_coche">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required>

            <div class="accesorios-reserva">
                <h3>Accesorios añadidos</h3>
                <ul id="lista_accesorios"></ul>
            </div>

            <button type="submit">Alquilar</button>
            <button type="button" class="btn-cerrar">Cerrar</button>
        </form>
    </div>
</div>

<script>
    const btnAlquilar = document.querySelectorAll('.btn-alquilar');
    const btnAnadir = document.querySelectorAll('.btn-anadir');
    const modal = document.querySelector('.modal');
    const modalIdCoche = document.querySelector('#modal_id_coche');
    const listaAccesorios = document.querySelector('#lista_accesorios');

    // Función para mostrar el modal con el formulario de reserva
    function mostrarModal(id_coche) {
        modalIdCoche.value = id_coche;
        listaAccesorios.innerHTML = '';
        modal.style.display = 'block';
    }

    // Función para cerrar el modal
    function cerrarModal() {
        modal.style.display = 'none';
   <div class="coches-container">
    <?php while ($coche = mysqli_fetch_assoc($coches)) : ?>
        <div class="coche">
            <img src="<?php echo $coche['imagen']; ?>" alt="<?php echo $coche['marca'] . ' ' . $coche['modelo']; ?>">
            <h3><?php echo $coche['marca'] . ' ' . $coche['modelo']; ?></h3>
            <p><?php echo $coche['descripcion']; ?></p>
            <p>Precio diario: <?php echo $coche['precio_diario']; ?>€</p>
            <?php if ($coche['estado'] == 'libre') : ?>
                <a href="alquiler.php?id_coche=<?php echo $coche['id_coche']; ?>" class="button">Alquilar</a>
            <?php else : ?>
                <p>Este coche no está disponible actualmente.</p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<div class="accesorios-container">
    <?php while ($accesorio = mysqli_fetch_assoc($accesorios)) : ?>
        <div class="accesorio">
            <img src="<?php echo $accesorio['imagen']; ?>" alt="<?php echo $accesorio['nombre']; ?>">
            <h3><?php echo $accesorio['nombre']; ?></h3>
            <p><?php echo $accesorio['descripcion']; ?></p>
            <p>Precio: <?php echo $accesorio['precio']; ?>€</p>
            <a href="alquiler.php?id_accesorio=<?php echo $accesorio['id_accesorio']; ?>" class="button">Añadir al alquiler</a>
        </div>
    <?php endwhile; ?>
</div>


   
