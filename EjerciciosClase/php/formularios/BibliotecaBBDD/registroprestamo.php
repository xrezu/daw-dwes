<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Préstamo</title>
</head>
<body>
  <h1>Registrar Nuevo Préstamo</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="id_libro">ID del Libro:</label>
    <input type="text" name="id_libro" id="id_libro" required pattern="[0-9]+" title="Ingrese un número entero válido">
    <label for="id_cliente">ID del Cliente:</label>
    <input type="text" name="id_cliente" id="id_cliente" required pattern="[0-9]+" title="Ingrese un número entero válido">
    <label for="fecha_prestamo">Fecha del Préstamo:</label>
    <input type="date" name="fecha_prestamo" id="fecha_prestamo" required>
    <button type="submit" name="registrar">Registrar Préstamo</button>
  </form>

  <?php
  // Incluir archivo de conexión
  include 'conexion.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id_libro = $_POST["id_libro"];
      $id_cliente = $_POST["id_cliente"];
      $fecha_prestamo = $_POST["fecha_prestamo"];

      // Verificar si el ID del libro y del cliente existen
      $stmt_libro = $conn->prepare("SELECT * FROM libros WHERE id = :id");
      $stmt_libro->bindParam(':id', $id_libro);
      $stmt_libro->execute();
      $libro = $stmt_libro->fetch(PDO::FETCH_ASSOC);

      $stmt_cliente = $conn->prepare("SELECT * FROM clientes WHERE id = :id");
      $stmt_cliente->bindParam(':id', $id_cliente);
      $stmt_cliente->execute();
      $cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);

      if (!$libro) {
          echo "El ID del libro no existe.";
          exit;
      }

      if (!$cliente) {
          echo "El ID del cliente no existe.";
          exit;
      }

      // Insertar el nuevo préstamo
      $sql = "INSERT INTO prestamos (id_libro, id_cliente, fecha_prestamo) VALUES (:id_libro, :id_cliente, :fecha_prestamo)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id_libro', $id_libro);
      $stmt->bindParam(':id_cliente', $id_cliente);
      $stmt->bindParam(':fecha_prestamo', $fecha_prestamo);
      $stmt->execute();

      echo "El préstamo se ha registrado correctamente.";
  }
  ?>
</body>
</html>
