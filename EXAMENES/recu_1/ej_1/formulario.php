<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Pedido</title>
</head>
<body>
  <h1>Formulario de Pedido</h1>
  <?php
  $errors = [];
  $nombre = $direccion = $tipo_suscripcion = '';
  $generos = [];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (empty($_POST["nombre"])) {
      $errors['nombre'] = "El nombre es obligatorio";
    } else {
      $nombre = htmlspecialchars($_POST["nombre"]);
    }

    // Validar dirección
    if (empty($_POST["direccion"])) {
      $errors['direccion'] = "La dirección es obligatoria";
    } else {
      $direccion = htmlspecialchars($_POST["direccion"]);
    }

    // Validar tipo de suscripción
    if (empty($_POST["tipo_suscripcion"])) {
      $errors['tipo_suscripcion'] = "El tipo de suscripción es obligatorio";
    } else {
      $tipo_suscripcion = htmlspecialchars($_POST["tipo_suscripcion"]);
    }

    // Validar géneros
    if (empty($_POST["generos"])) {
      $errors['generos'] = "Debe seleccionar al menos un género";
    } else {
      $generos = $_POST["generos"];
    }

    // Si no hay errores, redirigir a la página de éxito
    if (empty($errors)) {
      $parametros_url = http_build_query([
        "nombre" => $nombre,
        "direccion" => $direccion,
        "tipo_suscripcion" => $tipo_suscripcion,
        "generos" => $generos
      ]);

      header("Location: exito.php?" . $parametros_url);
      die();
    }
  }
  ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
    <span><?php echo isset($errors['nombre']) ? $errors['nombre'] : ''; ?></span><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
    <span><?php echo isset($errors['direccion']) ? $errors['direccion'] : ''; ?></span><br>

    <label for="tipo_suscripcion">Tipo de Suscripción:</label>
    <select id="tipo_suscripcion" name="tipo_suscripcion" required>
      <option value="mensual" <?php echo ($tipo_suscripcion == 'mensual') ? 'selected' : ''; ?>>Mensual</option>
      <option value="trimestral" <?php echo ($tipo_suscripcion == 'trimestral') ? 'selected' : ''; ?>>Trimestral</option>
    </select>
    <span><?php echo isset($errors['tipo_suscripcion']) ? $errors['tipo_suscripcion'] : ''; ?></span><br>

    <label for="generos">Géneros:</label>
    <select id="generos" name="generos[]" multiple required>
      <option value="rock" <?php echo (in_array('rock', $generos)) ? 'selected' : ''; ?>>Rock</option>
      <option value="jazz" <?php echo (in_array('jazz', $generos)) ? 'selected' : ''; ?>>Jazz</option>
      <option value="pop" <?php echo (in_array('pop', $generos)) ? 'selected' : ''; ?>>Pop</option>
      <option value="clasica" <?php echo (in_array('clasica', $generos)) ? 'selected' : ''; ?>>Clásica</option>
    </select>
    <span><?php echo isset($errors['generos']) ? $errors['generos'] : ''; ?></span><br>

    <input type="submit" value="Enviar">
  </form>
</body>
</html>
