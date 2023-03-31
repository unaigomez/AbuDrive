<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php"); // redirigir si no ha iniciado sesión
    exit();
}

$id_usuario = $_SESSION["usuario_id"];
// el resto de tu código para mostrar los coches disponibles para alquilar
?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "AbuDrive";

    $conn = mysqli_connect($servername, $username, $password, $dbname);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alquiler de coches</title>
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <form method="post" action="procesar_alquiler.php">
                        <h2>Alquilar coche</h2>
                        <div class="inputbox">
                            <input type="date" id="fecha_inicio" name="fecha_inicio" required><br>
                            <label for="fecha_inicio">Fecha de inicio</label>
                        </div>
                        <div class="inputbox">
                            <input type="date" id="fecha_fin" name="fecha_fin" required><br>
                            <label for="fecha_fin">Fecha de fin</label>
                        </div>
                        <div class="inputbox">
                            <label for="id_coche">Coche</label>
                            <select name="id_coche" id="id_coche">
                                <?php
                                    $sql = "SELECT id_coche, modelo FROM coches";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_coche'] . "'>" . $row['modelo'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="id_accesorio">Accesorio</label>
                            <select name="id_accesorio" id="id_accesorio">
                                <?php
                                    $sql = "SELECT id_accesorio, nombre FROM accesorios";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_accesorio'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="inputbox">
                            <input type="number" id="cantidad" name="cantidad"><br>
                            <label for="cantidad">Cantidad</label>
                        </div>
                        <div>
                            <button>Alquilar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>


<?php
if (!empty($error)) {
    echo "<p>$error</p>";
}
?>
