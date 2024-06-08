Mostrar desde CSV

<?php
if (($file = fopen('datos.csv', 'r')) !== FALSE) {
    echo '<table border="1">';
    echo '<tr><th>Nombre</th><th>Departamento</th><th>Mote</th></tr>';
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        echo '<tr>';
        foreach ($data as $field) {
            echo '<td>' . htmlspecialchars($field) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    fclose($file);
}
?>


Mostrar desde JSON:
  <?php
$data = file_get_contents('datos.json');
$jsonArray = json_decode($data, true);

if (!empty($jsonArray)) {
    echo '<table border="1">';
    echo '<tr><th>Nombre</th><th>Departamento</th><th>Mote</th></tr>';
    foreach ($jsonArray as $item) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($item['nombre']) . '</td>';
        echo '<td>' . htmlspecialchars($item['departamento']) . '</td>';
        echo '<td>' . htmlspecialchars($item['mote']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>