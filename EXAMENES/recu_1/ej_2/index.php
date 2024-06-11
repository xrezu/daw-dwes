<?php
include 'autoload.php';

$avistamientos = [];

if (($handle = fopen("avistamientos.csv", "r")) !== FALSE) {
  $is_header = true; 
  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    if ($is_header) {
      $is_header = false;
      continue; 
    }

    // Convertir array CSV en cadena delimitada por ';'
    $cadena = implode(';', $data);

    try {
      $avistamientos[] = Avistamiento::cargarInfo($cadena);
    } catch (Exception $e) {
      echo "Error al procesar avistamiento: " . $e->getMessage() . "<br>";
    }
  }
  fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Avistamientos</title>
</head>

<body>
  <h1>Listado de Avistamientos</h1>
  <?php
  foreach ($avistamientos as $avistamiento) {
    echo $avistamiento->pintarHTML();
  }
  ?>
</body>

</html>