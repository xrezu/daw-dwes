<?php
include 'bbdd/BaseDatos.php';

// Inicializa la base de datos
$bd = BaseDatos::obtenerInstancia();
$bd->inicializa('earth_day','root','1234','mysql','localhost');

$registrosPorPagina = 5;

$sqlCount = "SELECT COUNT(*) as total FROM actions";
$bd->ejecuta($sqlCount);
$totalRegistros = $bd->obtenDatos(BaseDatos::FETCH_COLUMNA);

//Calculo el número de páginas
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

//Obtenemos la página actual desde la URL, seteamos que por defecto sea 1
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($paginaActual < 1) $paginaActual = 1;
if ($paginaActual > $totalPaginas) $paginaActual = $totalPaginas;

//Calculamos el offset para la consulta
$offset = ($paginaActual - 1) * $registrosPorPagina;

//obtenemos los registros de la página actual

$sql = "SELECT * FROM actions ORDER BY date DESC LIMIT :limit OFFSET :offset";
$bd->ejecuta($sql, ['limit' => $registrosPorPagina, 'offset' => $offset]);
$actions = $bd->obtenDatos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Acciones</title>
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
    .actions-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .action {
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: calc(33.333% - 20px); 
      box-sizing: border-box;
    }
    .action img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
    }
    
    
    /*CREO ESTILAZO PARA LA PAGINACIÓN */
    .pagination {
      margin-top: 20px;
      text-align: center;
    }
    .pagination a {
      display: inline-block;
      padding: 8px 16px;
      margin: 0 4px;
      border: 1px solid #ddd;
      color: #333;
      text-decoration: none;
    }
    .pagination a.active {
      background-color: #28a745;
      color: #fff;
      border: 1px solid #28a745;
    }
    .pagination a:hover {
      background-color: #ddd;
    }
  </style>
</head>
<body>
    <h1>Acciones de Grinpi Registradas</h1>
    <a href="register_action.php">Registrar nueva acción</a>
    <hr>
    <div id="actions-container">
      <?php if(!empty($actions)): ?>
        <?php foreach ($actions as $action): ?>
          <div class="action">
            <h2><?php echo htmlspecialchars($action['place'])?></h2>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($action['date']); ?></p>
            <p><strong><?php echo htmlspecialchars($action['name']); ?></strong></p>
            <p><?php echo htmlspecialchars($action['description']); ?></p>
            <?php if(!empty($action['photo'])): ?>
              <img src="<?php echo htmlspecialchars($action['photo']);?>" alt="Foto de la acción">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p> No hay acciones registradas </p>
      <?php endif; ?>
    </div>


    <!-- botones de la páginación to guapos -->

    <div class="pagination">
      <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
        <a href="?pagina<?php echo $i; ?>" class="<?php echo $i == $paginaActual ? 'active' : ''; ?>"><?php echo $i; ?> </a>
      <?php endfor; ?>
    </div>
</body>
</html>
