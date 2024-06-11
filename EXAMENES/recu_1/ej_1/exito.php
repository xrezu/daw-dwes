<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedido Exitoso</title>
</head>
<body>
  <h1>¡Pedido realizado con éxito!</h1>
  <p>Gracias por tu pedido. Aquí están los detalles:</p>
  <ul>
    <li><strong>Nombre:</strong> <?php echo htmlspecialchars($_GET['nombre']); ?></li>
    <li><strong>Dirección:</strong> <?php echo htmlspecialchars($_GET['direccion']); ?></li>
    <li><strong>Tipo de Suscripción:</strong> <?php echo htmlspecialchars($_GET['tipo_suscripcion']); ?></li>
    <li><strong>Géneros:</strong> <?php echo htmlspecialchars(implode(', ', $_GET['generos'])); ?></li>
  </ul>
</body>
</html>
