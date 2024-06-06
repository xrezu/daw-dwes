### Apuntes Breves sobre Paginación en PHP

#### Conceptos Clave

1. **Página Actual**: La página que el usuario está viendo actualmente.
2. **Resultados por Página**: La cantidad de resultados mostrados en cada página.
3. **Offset**: La cantidad de resultados que se saltan antes de comenzar a contar los resultados que se van a mostrar.
4. **Total de Resultados**: El número total de resultados disponibles en la base de datos.
5. **Total de Páginas**: El número total de páginas necesario para mostrar todos los resultados.

#### Pasos para Implementar Paginación

1. **Determinar la Página Actual**
   - Obtener el número de la página actual desde la URL, y si no está definido, usar la página 1 por defecto.
   ```php
   $pagina = $_GET['pagina'] ?? 1;
   ```

2. **Definir el Número de Resultados por Página**
   - Establecer una cantidad fija de resultados que se mostrarán por página.
   ```php
   $resultados_por_pagina = 10;
   ```

3. **Calcular el Offset**
   - Calcular cuántos resultados deben ser saltados para obtener los resultados de la página actual.
   ```php
   $offset = ($pagina - 1) * $resultados_por_pagina;
   ```

4. **Obtener el Total de Resultados**
   - Ejecutar una consulta para contar el número total de registros en la base de datos.
   ```php
   $query = "SELECT COUNT(*) FROM resultados";
   $total_resultados = $pdo->query($query)->fetchColumn();
   ```

5. **Recuperar los Resultados de la Página Actual**
   - Ejecutar una consulta con `LIMIT` y `OFFSET` para obtener los resultados específicos de la página actual.
   ```php
   $query = "SELECT * FROM resultados LIMIT :limit OFFSET :offset";
   $stmt = $pdo->prepare($query);
   $stmt->bindValue(':limit', $resultados_por_pagina, PDO::PARAM_INT);
   $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
   $stmt->execute();
   $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
   ```

6. **Calcular el Número Total de Páginas**
   - Dividir el número total de resultados por el número de resultados por página.
   ```php
   $total_paginas = ceil($total_resultados / $resultados_por_pagina);
   ```

7. **Generar Enlaces de Paginación**
   - Crear enlaces para cada página para permitir la navegación entre ellas.
   ```php
   for ($i = 1; $i <= $total_paginas; $i++) {
     echo "<a href=\"?pagina=$i\">$i</a> ";
   }
   ```

#### Ejemplo Breve de Código

```php
<?php
// Conectar a la base de datos SQLite
$pdo = new PDO('sqlite:' . __DIR__ . '/resultados.db');

// Determinar la página actual y los resultados por página
$pagina = $_GET['pagina'] ?? 1;
$resultados_por_pagina = 10;
$offset = ($pagina - 1) * $resultados_por_pagina;

// Obtener el total de resultados
$query = "SELECT COUNT(*) FROM resultados";
$total_resultados = $pdo->query($query)->fetchColumn();

// Obtener los resultados de la página actual
$query = "SELECT * FROM resultados LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':limit', $resultados_por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcular el total de páginas
$total_paginas = ceil($total_resultados / $resultados_por_pagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de Rugby</title>
</head>
<body>
  <h1>Resultados de Rugby</h1>
  <table>
    <thead>
      <tr>
        <th>País Contrincante</th>
        <th>Lugar</th>
        <th>Resultado de España</th>
        <th>Resultado del Contrincante</th>
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
  <div>
    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
      <a href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
</body>
</html>
```

### Resumen

1. **Página Actual**: Determina la página actual desde la URL.
2. **Resultados por Página**: Define una cantidad fija de resultados por página.
3. **Offset**: Calcula el desplazamiento en la base de datos para la página actual.
4. **Total de Resultados**: Obtiene el número total de resultados en la base de datos.
5. **Total de Páginas**: Calcula el número total de páginas necesarias.
6. **Enlaces de Paginación**: Genera enlaces para cada página para permitir la navegación.