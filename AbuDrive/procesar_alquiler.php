<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AbuDrive";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_COOKIE["usuario_id"])) {
    header("location: login.php");
    exit;
}

// Procesar el formulario de alquiler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $id_coche = $_POST["id_coche"];
    $id_accesorio = $_POST["id_accesorio"];
    $cantidad = $_POST["cantidad"];

        $precio_diario = mysqli_fetch_assoc(mysqli_query($conn, "SELECT precio_diario FROM coches WHERE id = '$id_coche'"))["precio_diario"];
        $dias_alquiler = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24);
        $precio_coche = $precio_diario * $dias_alquiler;
        $precio_accesorio = mysqli_fetch_assoc(mysqli_query($conn, "SELECT precio FROM accesorios WHERE id = '$id_accesorio'"))["precio"];
        $precio_final = $precio_coche + ($precio_accesorio * $cantidad);
        
        // Insertar el alquiler en la base de datos
        $usuario_id = $_COOKIE["usuario_id"];
        $sql = "INSERT INTO alquileres (usuario_id, fecha_inicio, fecha_fin, id_coche, precio_final) VALUES ('$usuario_id', '$fecha_inicio', '$fecha_fin', '$id_coche', '$precio_final')";
        if (mysqli_query($conn, $sql)) {
            $alquiler_id = mysqli_insert_id($conn);

            // Insertar los accesorios del alquiler en la tabla intermedia
            $sql = "INSERT INTO alquileres_accesorios (id_alquiler, id_accesorio, cantidad) VALUES ('$alquiler_id', '$id_accesorio', '$cantidad')";
            if (!mysqli_query($conn, $sql)) {
                $error = "Ha ocurrido un error al agregar el accesorio al alquiler.";
            }
        } else {
            $error = "Ha ocurrido un error al agregar el alquiler.";
        }
    

    // Redirigir a la página principal con el mensaje de error o éxito
    if (isset($error)) {
        echo "<p>Ha ocurrido un error al procesar el alquiler: $error</p>";
    } else {
        echo "<p>El alquiler ha sido procesado correctamente.</p>";
    }

}
?>
