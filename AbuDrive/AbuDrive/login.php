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
        
        setcookie("usuario_id", $row["id_usuario"], time() + 86400, "/");

        header("location: index.php");
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="css/estilos.css">
      <title>Login AbuDrive</title>
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h2>Login AbuDrive</h2>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
                            <label for="nombre_usuario">Usuario</label>
                            
                        </div>
                        
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" id="contraseña" name="contraseña" required><br>
                            <label for="contraseña">Contraseña</label>
                        </div>
                        <div>
                            <button>Iniciar Sesión</button>
                        </div>
                        <div class="register">
                            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>

<?php
if (!empty($error)) {
    echo "<p>$error</p>";
}
?>
