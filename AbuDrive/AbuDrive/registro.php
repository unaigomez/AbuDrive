<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">  
      <link rel="stylesheet" href="css/estiloregistro.css">
      <title>Registro AbuDrive</title>
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <form method="post" action="registrar.php">
                        <h2>Registro de usuarios</h2>
                        <div class="inputbox">
                            <label for="nombre_usuario">Usuario</label>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
                            
                        </div>
                        
                        <div class="inputbox">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" id="contraseña" name="contraseña" required><br>
                            
                        </div>
                        <div class="inputbox">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            
                        </div>
                        <div class="inputbox">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" required><br>
                            
                        </div>
                        <div class="inputbox">
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" name="telefono" required><br>
                            
                        </div>
                        
                        <div class="inputbox">
                            <label for="dni">DNI</label>
                            <input type="text" id="dni" name="dni" required><br>
                            
                        </div>
                        
                        <div class="inputbox">
                            <label for="correo">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" required><br>
                            
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