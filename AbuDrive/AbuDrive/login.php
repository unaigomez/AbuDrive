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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contraseña = '$contraseña'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["usuario_id"] = $row["id_usuario"];
        $_SESSION["nombre"] = $row["nombre_usuario"];
        header("location: index.php");
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>

    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" required><br>

    <input type="submit" value="Iniciar sesión">
    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>

</form>

<?php
if (!empty($error)) {
    echo "<p>$error</p>";
}
?>
