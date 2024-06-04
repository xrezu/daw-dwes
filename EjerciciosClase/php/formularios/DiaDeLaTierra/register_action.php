<?php
include 'bbdd/BaseDatos.php';

// Inicializa la base de datos
$bd = BaseDatos::obtenerInstancia();
$bd->inicializa('earth_day', 'root', '1234', 'mysql', 'localhost');

$errores = [];

$fecha = '';
$lugar = '';
$nombre = ''; // Opcional
$descripcion = ''; // Opcional
$foto = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Validación fecha
  $fecha = trim($_POST['date']);
  $fechaError = validateDate($fecha);
  if ($fechaError !== true) {
    $errores['fecha'] = $fechaError;
  }

  $lugar = trim($_POST['place']);
  if (empty($lugar)) {
    $errores['lugar'] = 'El lugar es obligatorio';
  }

  $nombre = trim($_POST['name']);
  if (empty($nombre)) {
    $nombre = 'Anónimo';
  }

  // Al ser un campo opcional no pasa nada si lo dejamos en blanco, con hacer el trim nos vale.
  $descripcion = trim($_POST['description']);

  // Solo procede si no hay errores
  if (empty($errores)) {
    // Manejo de imagen
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["photo"]["name"]);
      if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $foto = $target_file;

        // Inserta los datos en la base de datos
        $sql = "INSERT INTO actions (date, place, name, description, photo) VALUES (?, ?, ?, ?, ?)";
        $bd->ejecuta($sql, [$fecha, $lugar, $nombre, $descripcion, $foto]);

        if ($bd->getExecuted()) {
          header('Location: exito.php');
          exit();
        } else {
          echo 'Hubo un error al registrar la acción';
          // Si hay un error al registrar la acción, elimina la imagen subida
          if (file_exists($target_file)) {
            unlink($target_file);
          }
        }
      } else {
        $errores['foto'] = 'Hubo un error al subir la imagen';
      }
    } else {
      $errores['foto'] = 'El campo foto es obligatorio';
    }
  }
}

function validateDate($date, $format = 'Y-m-d') {
  $d = DateTime::createFromFormat($format, $date);
  if (!$d || $d->format($format) !== $date) {
    return 'El formato de fecha no es válido';
  }
  $today = new DateTime();
  if ($d <= $today) {
    return 'La fecha debe ser posterior a la fecha actual';
  }
  return true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grinpi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    h1 {
      color: #333;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: auto;
    }
    label {
      display: block;
      margin-top: 10px;
    }
    input[type="text"],
    input[type="date"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    button {
      display: block;
      width: 100%;
      padding: 10px;
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }
    button:hover {
      background: #218838;
    }
    .error {
      color: red;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <h1>Registrar Acción Ambiental</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="date">Fecha:</label>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($fecha); ?>" required><br>
    <?php if (isset($errores['fecha'])): ?><span class="error"><?php echo $errores['fecha']; ?></span><?php endif; ?><br>

    <label for="place">Lugar:</label>
    <input type="text" id="place" name="place" value="<?php echo htmlspecialchars($lugar); ?>" required><br>
    <?php if (isset($errores['lugar'])): ?><span class="error"><?php echo $errores['lugar']; ?></span><?php endif; ?><br>

    <label for="name">Nombre (opcional):</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($nombre); ?>"><br>
    <?php if (isset($errores['nombre'])): ?><span class="error"><?php echo $errores['nombre']; ?></span><?php endif; ?><br>

    <label for="description">Descripción (opcional):</label>
    <textarea id="description" name="description"><?php echo htmlspecialchars($descripcion); ?></textarea><br>
    <?php if (isset($errores['descripcion'])): ?><span class="error"><?php echo $errores['descripcion']; ?></span><?php endif; ?><br>

    <label for="photo">Foto de la acción:</label>
    <input type="file" id="photo" name="photo" accept="image/*" required><br>
    <?php if (isset($errores['foto'])): ?><span class="error"><?php echo $errores['foto']; ?></span><?php endif; ?><br>

    <button type="submit" name="enviar">Registrar Acción</button>
  </form>
</body>
</html>
