<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Éxito</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    .container {
      width: 80%;
      margin: 50px auto;
      text-align: center;
    }
    h1 {
      color: green;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>¡El libro se ha registrado exitosamente!</h1>
    <p>Gracias por registrar el libro en la biblioteca.</p>
    <p><strong>Título:</strong> <?php echo $_SESSION['titulo']; ?></p>
    <p><strong>Autor:</strong> <?php echo $_SESSION['autor']; ?></p>
    <p><strong>Año de Publicación:</strong> <?php echo $_SESSION['ano_publicacion']; ?></p>
    <p><a href="formulario.php">Volver al formulario</a></p>
  </div>
</body>
</html>