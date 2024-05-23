<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Teléfono</title>
</head>
<body>
  <h1>Actualizar Teléfono de Cliente</h1>
  <form action="actualizartelefono.php" method="post">
    <label for="cliente_id">ID del Cliente:</label>
    <input type="text" name="cliente_id" id="cliente_id" required pattern="[0-9]+" title="Ingrese un número entero válido">
    <label for="nuevo_telefono">Nuevo Número de Teléfono (formato 000-000-000):</label>
    <input type="text" name="nuevo_telefono" id="nuevo_telefono" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" title="Ingrese un número de teléfono en formato 000-000-000">
    <button type="submit" name="actualizar">Actualizar Teléfono</button>
  </form>
</body>
</html>