<?php
if (!isset($_GET['nombre']) || !isset($_GET['flor']) || !isset($_GET['fecha']) || !isset($_GET['cantidad'])) {
  header("Location: index.php");
  die();
} else {
  $nombre = htmlspecialchars($_GET['nombre']);
  $flor = htmlspecialchars($_GET['flor']);
  $fecha = htmlspecialchars($_GET['fecha']);
  $cantidad = htmlspecialchars($_GET['cantidad']);

  //$fecha_formateada = date("j \d\e F \d\e\l Y", strtotime($fecha));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedido exitoso</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
  <h1>¡Pedido realizado con éxito!</h1>
  <p>Gracias por su pedido. Aquí están los detalles:</p>
  <ul>
    <li>Tu nombre: <?= $nombre ?></li>
    <li>Fecha: <?= $fecha ?></li>
    <li>Flor: <?= $flor ?></li>
    <li>Cantidad: <?= $cantidad ?></li>
  </ul>
  <a href="index.php">Volver al inicio</a>
</body>

</html>