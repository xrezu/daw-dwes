### Apuntes para Crear un Formulario de Captura y Almacenamiento de Datos en PHP (CSV y JSON)

#### 1. Estructura Básica del Formulario HTML

Crea un formulario HTML para capturar los datos necesarios. Asegúrate de incluir todos los campos requeridos.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Captura de Datos</title>
</head>
<body>
    <h1>Formulario de Captura de Datos</h1>
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
```

#### 2. Guardar Datos en CSV

Crea un script PHP (`save.php`) para procesar el formulario y guardar los datos en un archivo CSV.

```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $departamento = $_POST['departamento'];
    $mote = $_POST['mote'];

    // Guardar datos en CSV
    $file = fopen('datos.csv', 'a');
    fputcsv($file, [$nombre, $departamento, $mote]);
    fclose($file);

    header('Location: index.html');
    exit();
}
?>
```

#### 3. Guardar Datos en JSON

Extiende el script `save.php` para guardar también los datos en un archivo JSON.

```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $departamento = $_POST['departamento'];
    $mote = $_POST['mote'];

    // Guardar datos en CSV
    $file = fopen('datos.csv', 'a');
    fputcsv($file, [$nombre, $departamento, $mote]);
    fclose($file);

    // Guardar datos en JSON
    $data = file_get_contents('datos.json');
    $jsonArray = json_decode($data, true);
    $jsonArray[] = ['nombre' => $nombre, 'departamento' => $departamento, 'mote' => $mote];
    file_put_contents('datos.json', json_encode($jsonArray, JSON_PRETTY_PRINT));

    header('Location: index.html');
    exit();
}
?>
```

#### 4. Mostrar el Listado de Datos desde CSV

Crea un script PHP (`list.php`) para mostrar los datos almacenados en el archivo CSV.

```php
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
```

#### 5. Mostrar el Listado de Datos desde JSON

Opcionalmente, extiende `list.php` para mostrar los datos almacenados en JSON.

```php
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
```

### Estructura de Archivos

Asegúrate de que tu estructura de archivos sea la siguiente:

```
/
|-- index.html
|-- save.php
|-- list.php
|-- datos.csv (se creará automáticamente cuando se agreguen datos)
|-- datos.json (se creará automáticamente cuando se agreguen datos)
```

### Resumen de Pasos

1. **Crear el formulario HTML**: Captura los datos del empleado (nombre, departamento, mote).
2. **Guardar datos en CSV**:
   - Abre el archivo CSV en modo de escritura.
   - Escribe los datos del formulario en el archivo CSV.
   - Cierra el archivo CSV.
3. **Guardar datos en JSON**:
   - Lee el contenido actual del archivo JSON.
   - Decodifica el JSON en un array.
   - Agrega los nuevos datos al array.
   - Codifica el array en formato JSON y guarda en el archivo JSON.
4. **Mostrar datos desde CSV**:
   - Abre el archivo CSV en modo de lectura.
   - Lee los datos y genera una tabla HTML.
   - Cierra el archivo CSV.
5. **Mostrar datos desde JSON** (opcional):
   - Lee el contenido del archivo JSON.
   - Decodifica el JSON en un array.
   - Genera una tabla HTML con los datos.

Estos apuntes te proporcionan una guía general para implementar un sistema de captura y almacenamiento de datos en PHP utilizando tanto archivos CSV como JSON.