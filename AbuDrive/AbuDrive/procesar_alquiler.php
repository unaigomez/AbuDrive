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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_coche = $_POST["id_coche"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $accesorios = isset($_POST["accesorios"]) ? $_POST["accesorios"] : [];

    $usuario_id = $_SESSION["usuario_id"];

    $sql_coche = "SELECT * FROM coches WHERE id_coche = $id_coche";
    $result_coche = mysqli_query($conn, $sql_coche);
    $coche = mysqli_fetch_assoc($result_coche);

    $dias = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24);

    $precio_final = $coche["precio_diario"] * $dias;

    foreach ($accesorios as $id_accesorio) {
        $cantidad = $_POST["accesorio_cantidad_" . $id_accesorio];
        $sql_accesorio = "SELECT * FROM accesorios WHERE id_accesorio = $id_accesorio";
        $result_accesorio = mysqli_query($conn, $sql_accesorio);
        $accesorio = mysqli_fetch_assoc($result_accesorio);

        $costo_accesorio = $accesorio["precio"] * $cantidad;
        $precio_final += $costo_accesorio;
    }

    $sql_alquiler = "INSERT INTO alquileres (fecha_inicio, fecha_fin, id_usuario, id_coche, precio_final) VALUES ('$fecha_inicio', '$fecha_fin', $usuario_id, $id_coche, $precio_final)";    

    if (mysqli_query($conn, $sql_alquiler)) {
        $id_alquiler = mysqli_insert_id($conn);
        echo "Nuevo registro de alquiler creado correctamente. ID Alquiler: " . $id_alquiler . "<br>";

        // Cambiar el estado del coche a ocupado
        $sql_update_coche = "UPDATE coches SET estado = 'ocupado' WHERE id_coche = $id_coche";
        if (mysqli_query($conn, $sql_update_coche)) {
            echo "Estado del coche actualizado a ocupado.<br>";
        } else {
            echo "Error: " . $sql_update_coche . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql_alquiler . "<br>" . mysqli_error($conn);
    }

    foreach ($accesorios as $id_accesorio) {
        $cantidad = $_POST["accesorio_cantidad_" . $id_accesorio];
        $sql_accesorio = "SELECT * FROM accesorios WHERE id_accesorio = $id_accesorio";
        $result_accesorio = mysqli_query($conn, $sql_accesorio);
        $accesorio = mysqli_fetch_assoc($result_accesorio);

        $costo_total = $accesorio["precio"] * $cantidad;

        $sql_alquiler_accesorio = "INSERT INTO alquileres_accesorios (id_alquiler, id_accesorio, cantidad, costo_total) VALUES ($id_alquiler, $id_accesorio, $cantidad, $costo_total)";
        mysqli_query($conn, $sql_alquiler_accesorio);
    }

    mysqli_close($conn);
    $_SESSION['marca_modelo'] = $coche['marca'] . ' ' . $coche['modelo'];
    $_SESSION['precio_diario'] = $coche['precio_diario'];
    $_SESSION['fecha_inicio'] = $fecha_inicio;
    $_SESSION['fecha_fin'] = $fecha_fin;

    $accesorios_data = [];
    foreach ($accesorios as $id_accesorio) {
        $cantidad = $_POST["accesorio_cantidad_" . $id_accesorio];
        $sql_accesorio = "SELECT * FROM accesorios WHERE id_accesorio = $id_accesorio";
        $result_accesorio = mysqli_query($conn, $sql_accesorio);
        $accesorio = mysqli_fetch_assoc($result_accesorio);

        $accesorios_data[] = [
            'nombre' => $accesorio['nombre'],
            'cantidad' => $cantidad,
            'precio' => $accesorio['precio'],
            'costo_total' => $accesorio['precio'] * $cantidad
        ];
    }

    $_SESSION['accesorios'] = $accesorios_data;
    $_SESSION['precio_total'] = $precio_final;

    header("location: exito.php");
    exit;
}
?>