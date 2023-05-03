<?php
session_start();

// Asegúrate de que las variables de sesión estén configuradas antes de intentar acceder a ellas
if (!isset($_SESSION['marca_modelo']) || !isset($_SESSION['precio_diario']) || !isset($_SESSION['fecha_inicio']) || !isset($_SESSION['fecha_fin']) || !isset($_SESSION['accesorios']) || !isset($_SESSION['precio_total'])) {
    header("location: index.php");
    exit;
}

$marca_modelo = $_SESSION['marca_modelo'];
$precio_diario = $_SESSION['precio_diario'];
$fecha_inicio = $_SESSION['fecha_inicio'];
$fecha_fin = $_SESSION['fecha_fin'];
$accesorios = $_SESSION['accesorios'];
$precio_total = $_SESSION['precio_total'];

// Limpia las variables de sesión relacionadas con el alquiler
unset($_SESSION['marca_modelo']);
unset($_SESSION['precio_diario']);
unset($_SESSION['fecha_inicio']);
unset($_SESSION['fecha_fin']);
unset($_SESSION['accesorios']);
unset($_SESSION['precio_total']);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Confirmación de alquiler</title>
    <style>
      /* Estilos para la página de confirmación */
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
      }
      .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      h1, h2 {
        text-align: center;
      }
      .confirmation-details {
        margin-top: 30px;
      }
      .confirmation-details ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      .confirmation-details ul li {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
      }
      .confirmation-details ul li:last-child {
        border-bottom: none;
      }
      .confirmation-details ul li span {
        font-weight: bold;
      }
      .button-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
      }
        button {
        background-color: #242DFB;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
      }

      button:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>¡Gracias por alquilar con nosotros!</h1>
      <h2>Confirmación de alquiler exitoso</h2>
      <div class="confirmation-details">
        <ul>
            <li>Coche: <?php echo $marca_modelo; ?></li>
            <li>Fecha inicio: <?php echo $fecha_inicio; ?></li>
            <li>Fin del alquiler: <?php echo $fecha_fin; ?></li>
            <li>Total: <?php echo $precio_total; ?>€</li>
        </ul>
      </div>
    </div>
    <div class="button-container">
        <button onclick="location.href='index.php';">Volver al inicio</button>
    </div>
  </body>
</html>
