<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario registro empleados</title>
</head>
<body>
  <form action="save.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>
    
    <label for="departamento">Departamento:</label>
    <input type="text" id="departamento" name="departamento" required><br><br>

    <label for="mote">Mote:</label>
    <input type="text" id="mote" name="mote" required><br><br>

    <button type="submit">Guardar</button>
  </form>

  <h2>Listado de Datos</h2>
  <div id="listado">
    <?php include 'list.php'; ?>
  </div>
</body>
</html>