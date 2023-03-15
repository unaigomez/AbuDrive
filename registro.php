<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">  
      <link rel="stylesheet" href="estilos.css">
      <title>Registro AbuDrive</title>
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <form method="post" action="registrar.php">
                        <h2>Registro de usuarios</h2>
                        <div class="inputbox">
                            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
                            <label for="nombre_usuario">Usuario</label>
                        </div>
                        
                        <div class="inputbox">
                            <input type="password" id="contraseña" name="contraseña" required><br>
                            <label for="contraseña">Contraseña</label>
                        </div>
                        <div class="inputbox">
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="inputbox">
                            <input type="text" id="apellidos" name="apellidos" required><br>
                            <label for="apellidos">Apellidos</label>
                        </div>
                        <div class="inputbox">
                            <input type="email" id="correo" name="correo" required><br>
                            <label for="correo">Correo electrónico</label>
                        </div>
                        <div>
                            <button>Registrarse</button>
                        </div>
                        <div class="register">
                            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>