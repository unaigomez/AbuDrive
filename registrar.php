<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AbuDrive";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$nombre_usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["contraseña"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$correo = $_POST["correo"];

$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "El nombre de usuario ya está en uso. Por favor, elige otro nombre de usuario.";
    echo '<a href="registro.php">Volver al registro</a>';
} else {
    $sql = "INSERT INTO usuarios (nombre_usuario, contraseña, nombre, apellidos, correo) VALUES ('$nombre_usuario', '$contraseña', '$nombre', '$apellidos', '$correo')";
    if (mysqli_query($conn, $sql)) {
        echo '<p>¡Te has registrado correctamente! Haz clic <a href="login.php">aquí</a> para volver al inicio de sesión.</p>';
    } else {
        echo "Ha habido un error al registrar al usuario: " . mysqli_error($conn);
        echo '<a href="login.php">Volver al inicio de sesión</a>';
    }
}

mysqli_close($conn);
?>
