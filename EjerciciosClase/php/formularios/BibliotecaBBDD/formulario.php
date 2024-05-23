<?php
// Incluir archivo de conexión
include 'conexion.php';

$errores = [];
$titulo = '';
$autor = '';
$ano_publicacion = '';

// Si el usuario envía el formulario
if (isset($_POST["enviar"])) {
    // Validación del campo título
    $titulo = trim($_POST["titulo"]);
    if (empty($titulo)) {
        $errores["titulo"] = "El campo título es obligatorio";
    } elseif (strlen($titulo) < 3) {
        $errores["titulo"] = "El título debe tener al menos 3 caracteres";
    } elseif (strlen($titulo) > 255) {
        $errores["titulo"] = "El título no puede exceder los 255 caracteres";
    }

    // Validación del campo autor
    $autor = trim($_POST["autor"]);
    if (empty($autor)) {
        $errores["autor"] = "El campo autor es obligatorio";
    } elseif (strlen($autor) < 3) {
        $errores["autor"] = "El autor debe tener al menos 3 caracteres";
    } elseif (strlen($autor) > 100) {
        $errores["autor"] = "El autor no puede exceder los 100 caracteres";
    }

    // Validación del campo año de publicación
    $ano_publicacion = trim($_POST["ano_publicacion"]);
    if (empty($ano_publicacion)) {
        $errores["ano_publicacion"] = "El campo año de publicación es obligatorio";
    } elseif (!is_numeric($ano_publicacion)) {
        $errores["ano_publicacion"] = "El año de publicación debe ser un número";
    } elseif (strlen($ano_publicacion) != 4 || $ano_publicacion < 1000 || $ano_publicacion > date("Y")) {
        $errores["ano_publicacion"] = "El año de publicación debe ser un número válido de 4 dígitos entre 1000 y el año actual";
    }

    // Si no hay errores, insertar el libro en la base de datos
    if (count($errores) == 0) {
        try {
            // Consulta SQL para insertar un nuevo libro
            $sql = "INSERT INTO libros (titulo, autor, ano_publicacion) VALUES (:titulo, :autor, :ano_publicacion)";
            // Preparar consulta
            $stmt = $conn->prepare($sql);
            // Vincular parámetros
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':ano_publicacion', $ano_publicacion);
            // Ejecutar consulta
            $stmt->execute();

            // Redirigir a exito.php
            header("Location: exito.php");
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    .container {
      width: 80%;
      margin: 0 auto;
    }
    h1 {
      text-align: center;
    }
    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
    }
    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .form-group button {
      background-color: #333;
      color: #fff;
      padding: 10px 15px;
      border: 0;
      border-radius: 5px;
      cursor: pointer;
    }
    .form-group button:hover {
      background-color: #555;
    }

    .error {
      background-color: #f8d7da;
      color: #842029;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value="<?=$titulo;?>">
        <?php if(isset($errores["titulo"])): ?>
          <span class="error"><?=$errores["titulo"];?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="autor">Autor</label>
        <input type="text" name="autor" id="autor" value="<?=$autor;?>">
        <?php if(isset($errores["autor"])): ?>
          <span class="error"><?=$errores["autor"];?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="ano_publicacion">Año de Publicación</label>
        <input type="text" name="ano_publicacion" id="ano_publicacion" value="<?=$ano_publicacion;?>">
        <?php if(isset($errores["ano_publicacion"])): ?>
          <span class="error"><?=$errores["ano_publicacion"];?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <button type="submit" name="enviar">Enviar</button>
      </div>
    </form>
  </div>
</body>
</html>
