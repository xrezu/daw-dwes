<?php
// Incluir archivo de conexión
include 'conexion.php';

// Definir el número de préstamos por página
$prestamosPorPagina = 3;

// Obtener el número total de préstamos
$stmt = $conn->query("SELECT COUNT(*) AS total FROM prestamos");
$totalPrestamos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalPrestamos / $prestamosPorPagina);

// Obtener el número de página actual
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el índice inicial del primer préstamo en la página actual
$indiceInicial = ($paginaActual - 1) * $prestamosPorPagina;

// Obtener los préstamos para la página actual
$stmt = $conn->prepare("SELECT * FROM prestamos LIMIT :indiceInicial, :prestamosPorPagina");
$stmt->bindParam(':indiceInicial', $indiceInicial, PDO::PARAM_INT);
$stmt->bindParam(':prestamosPorPagina', $prestamosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Préstamos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
      margin: 50px auto;
    }

    .prestamo {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    h2 {
      margin-top: 0;
    }

    p {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Lista de Préstamos</h1>
    <?php foreach ($prestamos as $prestamo): ?>
      <div class="prestamo">
        <h2>Préstamo #<?php echo $prestamo['id']; ?></h2>
        <p>ID del Libro: <?php echo $prestamo['id_libro']; ?></p>
        <p>ID del Cliente: <?php echo $prestamo['id_cliente']; ?></p>
        <p>Fecha del Préstamo: <?php echo $prestamo['fecha_prestamo']; ?></p>
      </div>
    <?php endforeach; ?>

    <!-- Navegación de páginas -->
    <div class="pagination">
      <?php if ($paginaActual > 1): ?>
        <a href="?pagina=<?php echo $paginaActual - 1; ?>">Anterior</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <a href="?pagina=<?php echo $i; ?>" <?php echo ($i === $paginaActual) ? 'style="font-weight: bold;"' : ''; ?>><?php echo $i; ?></a>
      <?php endfor; ?>

      <?php if ($paginaActual < $totalPaginas): ?>
        <a href="?pagina=<?php echo $paginaActual + 1; ?>">Siguiente</a>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
