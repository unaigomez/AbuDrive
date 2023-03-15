<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>
</head>
<body>
    <h1>Registro de usuarios</h1>
    <form method="post" action="registrar.php">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contraseña" id="contraseña" required>
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>
        <br>
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" id="correo" required>
        <br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
