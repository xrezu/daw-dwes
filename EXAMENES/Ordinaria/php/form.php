<?php

require 'funciones.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])) {

  $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
  $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : null;
  $flor_id = isset($_POST["flor"]) ? $_POST["flor"] : null;
  $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : null;

  if (empty($nombre)) {
    $errores['nombre'] = 'El nombre es un campo obligatorio';
  }

  $fechaError = validateDate($fecha);
  if ($fechaError !== true) {
    $errores['fecha'] = $fechaError;
  }

  if (empty($flor_id)) {
    $errores['flor'] = "Debes seleccionar una flor";
  }

  if (empty($cantidad)) {
    $errores['cantidad'] = "Debes especificar la cantidad";
  } else {
    $stockFlor = obtenerStock($flor_id);
    if ($stockFlor < $cantidad) {
      $errores['cantidad'] = "No hay stock para tu pedido.";
    }
  }

  if (empty($errores)) {
    actualizarStock($flor_id, $cantidad);
    insertarPedido($flor_id, $fecha, $cantidad);

    $parametros_url = http_build_query([
      "nombre" => $nombre,
      "fecha" => $fecha,
      "flor" => obtenerFlorPorId($flor_id),
      "cantidad" => $cantidad
    ]);

    header("Location: exito.php?" . $parametros_url);
    die();
  }
}


$flores = obtenerNbFlores();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body>

  <form action="" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>
    <?php if (isset($errores['nombre'])) : ?> 
      <span class="error"><?= $errores['nombre'] ?></span>
    <?php endif; ?> <br>
    
    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" id="fecha" required>
    <?php if (isset($errores["fecha"])) : ?>
      <span class="error"><?= $errores["fecha"] ?></span>
    <?php endif; ?> <br>

    <label for="flor">Flor</label>
    <select name="flor">
      <option selected disabled>Seleccione una flor</option>
      <?php foreach ($flores as $flor) : ?> <!-- Loop para rellenar el select con las flores -->
        <option value="<?= $flor["id"] ?>" <?= isset($flor_id) && $flor_id == $flor["id"] ? 'selected' : '' ?>>
          <?= $flor["nombre"] ?> (<?= $flor["stock"] ?>) <!-- Mostrar nombre y stock de la flor -->
        </option>
      <?php endforeach; ?>
    </select>
    <?php if (isset($errores["flor"])) : ?>
      <span class="error"><?= $errores["flor"] ?></span>
    <?php endif; ?> <br>

    <label for="cantidad">Cantidad:</label> <br>
    <input type="number" name="cantidad" value="<?= isset($cantidad) ? $cantidad : '' ?>">
    <?php if (isset($errores["cantidad"])) : ?>
      <span class="error"><?= $errores["cantidad"] ?></span>
    <?php endif; ?> <br>

    <input type="submit" name="enviar" value="Enviar">
  </form>

</body>

</html>
