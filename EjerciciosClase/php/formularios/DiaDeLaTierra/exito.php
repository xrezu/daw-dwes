<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Exitoso</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .message {
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
  </style>
  <script>
    // Redirigir a list_actions.php después de 5 segundos
    setTimeout(function() {
      window.location.href = 'list_actions.php';
    }, 5000);
  </script>
</head>
<body>
  <div class="message">
    <h1>Acción registrada con éxito</h1>
    <p>Serás redirigido a la lista de acciones en unos segundos.</p>
  </div>
</body>
</html>
