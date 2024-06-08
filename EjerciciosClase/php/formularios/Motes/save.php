<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $nombre = $_POST['nombre'];
  $departamento = $_POST['departamento'];
  $mote = $_POST['mote'];

  //Guardar a CSV
  $file = fopen('datos.csv', 'a');
  fputcsv($file, [$nombre,$departamento,$mote]);
  fclose($file);

  //Guardar a JSON
  $data = file_get_contents('datos.json');
  $jsonArray = json_decode($data, true);
  $jsonArray[] = ['nombre' => $nombre, 'departamento' => $departamento, 'mote' => $mote];
  file_put_contents('datos.json', json_encode($jsonArray, JSON_PRETTY_PRINT));

  header('Location:index.php');
  exit();
}

?>