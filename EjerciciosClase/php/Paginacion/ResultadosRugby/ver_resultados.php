<?php
require 'config.php';

$orden = $_GET['order'] ?? 'contrincante';
$pagina = $_GET['pagina'] ?? 1;
$resultados_x_pagina = 5;
$offset = ($pagina -1) * $resultados_x_pagina;

$bd->ejecuta("SELECT COUNT(*) FROM resultados");
$total_resultados = $bd->obtenDatos(BaseDatos::FETCH_COLUMNA);

$bd->ejecuta("SELECT * FROM resultados ORDER BY $orden LIMIT $resultados_x_pagina OFFSET $offset");
$resultados = $bd->obtenDatos();

$total_paginas = ceil($total_resultados/$resultados_x_pagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de Rugby</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      width: 80%;
      margin: auto;
      overflow: hidden;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      background-color: #fff;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    th a {
      text-decoration: none;
      color: #333;
    }

    .pagination {
      text-align: center;
      margin: 20px 0;
    }

    .pagination a {
      text-decoration: none;
      padding: 10px 15px;
      margin: 0 5px;
      border: 1px solid #ddd;
      color: #333;
      background-color: #f4f4f4;
    }

    .pagination a.active {
      background-color: #333;
      color: #fff;
      border: 1px solid #333;
    }

    .pagination a:hover {
      background-color: #ddd;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Resultados de Rugby</h1>
    <table>
      <thead>
        <tr>
          <th><a href="?order=contrincante">País Contrincante</a></th>
          <th><a href="?order=lugar">Lugar</a></th>
          <th><a href="?order=resultado_a">Resultado de España</a></th>
          <th><a href="?order=resultado_b">Resultado del Contrincante</a></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultados as $resultado): ?>
          <tr>
            <td><?php echo htmlspecialchars($resultado['contrincante']); ?></td>
            <td><?php echo htmlspecialchars($resultado['lugar']); ?></td>
            <td><?php echo htmlspecialchars($resultado['resultado_a']); ?></td>
            <td><?php echo htmlspecialchars($resultado['resultado_b']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="pagination">
      <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <a href="?order=<?php echo htmlspecialchars($orden); ?>&pagina=<?php echo $i; ?>" class="<?php echo ($i == $pagina) ? 'active' : ''; ?>"><?php echo $i; ?></a>
      <?php endfor; ?>
    </div>
  </div>
</body>
</html>