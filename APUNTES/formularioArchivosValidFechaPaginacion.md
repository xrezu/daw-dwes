### Apuntes sobre el Desarrollo de un Formulario de Registro y Listado de Datos en PHP

#### Introducción
Estos apuntes te guiarán en la creación de un formulario de registro y un listado de datos en una aplicación web utilizando PHP. Los puntos clave incluyen la validación de datos, el manejo de archivos, la conexión a la base de datos, la inserción de datos y la implementación de paginación para el listado de registros.

#### Puntos Clave del Formulario de Registro

1. **Estructura del Formulario**:
   - **Campos Obligatorios**: Fecha, Lugar.
   - **Campos Opcionales**: Nombre, Descripción.
   - **Archivo**: Foto de la acción.

2. **Validación de Datos**:
   - **Fecha**: Verificar que no esté vacía y sea posterior a la fecha actual.
   - **Lugar**: Verificar que no esté vacío.
   - **Nombre**: Asignar "Anónimo" si está vacío.
   - **Descripción**: Puede estar vacía.
   - **Foto**: Verificar que se haya subido un archivo y manejar posibles errores.

3. **Manejo de Archivos**:
   - Subir la foto a una carpeta en el servidor (`uploads/`).
   - Validar y manejar posibles errores durante la subida.

4. **Inserción en la Base de Datos**:
   - Preparar la consulta SQL para insertar los datos validados en la tabla correspondiente.
   - Ejecutar la consulta utilizando PDO para manejar la base de datos.

5. **Redirección Tras Registro Exitoso**:
   - Redirigir al usuario a una página de éxito (`exito.php`) tras una inserción exitosa.

#### Puntos Clave del Listado de Datos

1. **Conexión a la Base de Datos**:
   - Utilizar una clase para manejar la conexión y las consultas a la base de datos.

2. **Consulta y Paginación**:
   - **Total de Registros**: Ejecutar una consulta para contar el total de registros.
   - **Número de Páginas**: Calcular el número de páginas dividiendo el total de registros por el número de registros por página.
   - **Página Actual y Offset**: Determinar la página actual y calcular el offset para la consulta SQL.
   - **Consulta con Paginación**: Obtener los registros correspondientes a la página actual utilizando `LIMIT` y `OFFSET`.

3. **Visualización de Registros**:
   - Mostrar cada registro en un `div` individual.
   - Incluir detalles como Fecha, Lugar, Nombre, Descripción y Foto.
   - Utilizar CSS para una presentación estética.

4. **Enlaces de Paginación**:
   - Generar enlaces para navegar entre las páginas.
   - Destacar la página actual en los enlaces de paginación.

#### Ejemplo de Validación de Fecha

```php
function validateDate($date, $format = 'Y-m-d') {
  $d = DateTime::createFromFormat($format, $date);
  if (!$d || $d->format($format) !== $date) {
    return 'El formato de fecha no es válido';
  }
  $today = new DateTime();
  if ($d <= $today) {
    return 'La fecha debe ser posterior a la fecha actual';
  }
  return true;
}
```

#### Ejemplo de Manejo de Archivos

```php
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["photo"]["name"]);
  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
    $foto = $target_file;
  } else {
    $errores['foto'] = 'Hubo un error al subir la imagen';
  }
} else {
  $errores['foto'] = 'El campo foto es obligatorio';
}
```

#### Ejemplo de Inserción en la Base de Datos

```php
$sql = "INSERT INTO actions (date, place, name, description, photo) VALUES (?, ?, ?, ?, ?)";
$bd->ejecuta($sql, [$fecha, $lugar, $nombre, $descripcion, $foto]);

if ($bd->getExecuted()) {
  header('Location: exito.php');
  exit();
} else {
  echo 'Hubo un error al registrar la acción';
  if (file_exists($target_file)) {
    unlink($target_file);
  }
}
```

#### Ejemplo de Paginación en Consulta SQL

```php
// Calcula el offset para la consulta SQL
$offset = ($paginaActual - 1) * $registrosPorPagina;

// Obtiene los registros de la página actual
$sql = "SELECT * FROM actions ORDER BY date DESC LIMIT :limit OFFSET :offset";
$bd->ejecuta($sql, ['limit' => $

registrosPorPagina, 'offset' => $offset]);
$actions = $bd->obtenDatos();
```

#### Ejemplo de Generación de Enlaces de Paginación

```php
<div class="pagination">
  <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
    <a href="?pagina=<?php echo $i; ?>" class="<?php echo $i == $paginaActual ? 'active' : ''; ?>"><?php echo $i; ?></a>
  <?php endfor; ?>
</div>
```

#### Resumen
Estos apuntes proporcionan una guía rápida para desarrollar un formulario de registro y un listado de datos en PHP con paginación. Se cubren los aspectos clave de la validación de datos, manejo de archivos, inserción en la base de datos y la implementación de paginación para el listado de registros. Utiliza los ejemplos de código para implementar rápidamente estas funcionalidades en tus proyectos.