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
$telefono = $_POST["telefono"];
$dni = $_POST["dni"];
$correo = $_POST["correo"];

$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; font-family: Arial, sans-serif;"><p style="font-size: 2em; text-align: center;">El nombre de usuario ya está en uso. Por favor, elige otro nombre de usuario. Haz clic <a href="registro.php">aquí</a> para volver al registro.</p></div>';    
} else {
    $sql = "INSERT INTO usuarios (nombre_usuario, contraseña, nombre, apellidos, telefono, dni, correo) VALUES ('$nombre_usuario', '$contraseña', '$nombre', '$apellidos', '$telefono', '$dni', '$correo')";
    if (mysqli_query($conn, $sql)) {
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; font-family: Arial, sans-serif;"><p style="font-size: 2em; text-align: center;">¡Te has registrado correctamente! Haz clic <a href="login.php">aquí</a> para volver al inicio de sesión.</p></div>';
    } else {
        echo "Ha habido un error al registrar al usuario: " . mysqli_error($conn);
        echo '<a href="login.php">Volver al inicio de sesión</a>';
    }
}

mysqli_close($conn);
?>
