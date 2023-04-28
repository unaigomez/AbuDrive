<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AbuDrive";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$coches = mysqli_query($conn, "SELECT * FROM coches WHERE estado = 'libre'");
$accesorios = mysqli_query($conn, "SELECT * FROM accesorios");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alquiler de coches - AbuDrive</title>
</head>
<body>
    <section>
        <div class="form-box">
            <form method="post" action="procesar_alquiler.php">
                <h2>Alquiler de coches</h2>

                <label for="id_coche">Selecciona un coche:</label>
                <select name="id_coche" id="id_coche">
                    <?php while ($coche = mysqli_fetch_assoc($coches)) : ?>
                        <option value="<?php echo $coche['id_coche']; ?>">
                            <?php echo $coche['marca'] . ' ' . $coche['modelo'] . ' (' . $coche['precio_diario'] . '€/día)'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>

                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required>

                <label for="accesorios">Accesorios:</label>
                <?php while ($accesorio = mysqli_fetch_assoc($accesorios)) : ?>
                    <div>
                        <input type="checkbox" id="accesorio_<?php echo $accesorio['id_accesorio']; ?>" name="accesorios[]" value="<?php echo $accesorio['id_accesorio']; ?>">
                        <label for="accesorio_<?php echo $accesorio['id_accesorio']; ?>">
                            <?php echo $accesorio['nombre'] . ' (' . $accesorio['precio'] . '€)'; ?>
                        </label>
                        Cantidad: <select name="accesorio_cantidad_<?php echo $accesorio['id_accesorio']; ?>">
                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                <?php endwhile; ?>

                <button type="submit">Alquilar</button>
            </form>
        </div>
    </section>
</body>
</html>
