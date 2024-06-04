# <span style="color:red">TODO ESTÁ PUESTO EN EL ORDEN QUE DEBERIA IR EN EL CÓDIGO PHP</span>

# <span style="color:red">Parte superior al código HTML es decir el código PhP '<<span hidden="hidden">¿</span>?php ... ?>'</span>

# Declaración de funciones y variables

### Se define una función `limpiar_entrada($datos)` para limpiar la entrada de datos, eliminando espacios en blanco iniciales y finales, barras invertidas y caracteres especiales.

```php
    function limpiar_entrada($datos)
    {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        return htmlspecialchars($datos);
    }
```

### Se declara una variable `$preguntas` que se inicializa con las preguntas leídas desde el archivo "preguntas.txt".
### Se calcula el número de preguntas con la función `count()`.
### Se inicializan las variables `$nombre`, `$respuestas` y `$errores`.

```php
    $preguntas = file('preguntas.txt', FILE_IGNORE_NEW_LINES);
    
    $num_preguntas = count($preguntas);

    $nombre = '';
    $respuestas = array_fill(0, $num_preguntas, '');
    $errores = [];
```

# Procesamiento del formulario

### Se verifica si el método de solicitud es POST.

```php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Aquí va todo el código de validación de campos
    }
```

### Se valida el campo "nombre" del formulario. Si está vacío, se agrega un error a la lista de errores.

```php
    if(empty($_POST['nombre'])){
            $errores[] = 'El nombre es requerido';
    }
    else{
        $nombre = limpiar_entrada($_POST['nombre']);
    }
```

### Se limpia y valida el campo "respuestas" del formulario, si hay errores, se procesan y se asignan las respuestas del formulario al array `$respuestas`.

```php
    $respuestas_post = $_POST['respuestas']??[];
    
    if(count($respuestas_post) != $num_preguntas){
        $errores[] = 'Debe responder a todas las preguntas';

        foreach ($respuestas_post as $index => $respuesta) {
            $respuestas[$index] = limpiar_entrada($respuesta);
        }
    }
    else{
        $respuestas = array_map('limpiar_entrada', $respuestas_post);
    }
```

### Si no hay errores, se guarda la información en el archivo "respuestas.csv", se genera una cadena `$envio` con las respuestas y se redirige al usuario a `grafico.php` pasando los datos por URL.

```php
    if(empty($errores)){
        // Si no hay errores, procesar los datos
        $linea = $nombre . ';' . implode(';', $respuestas) . "\n";
        $envio = implode(';', $respuestas);
        file_put_contents('respuestas.csv', $linea, FILE_APPEND);
        header("Location: grafico.php?envio=" . urlencode($envio));
        die();
    }
```

# Formulario HTML

### Se muestra un formulario HTML que recoge el nombre y las respuestas a las preguntas, para cada pregunta, se muestran tres radio buttons con las opciones "Nada", "Normal" y "Mucho".

```php
    <form action="encuesta.php" method="post">
        Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>"><br><br>
    
         <?php
            foreach($preguntas as $i => $pregunta){
                echo "<p>$pregunta</p>";
    
                echo "<input type='radio' name='respuestas[$i]' value='0' " . ($respuestas[$i] == '0' ? 'checked' : '') . '> Nada ';
                echo "<input type='radio' name='respuestas[$i]' value='1' " . ($respuestas[$i] == '1' ? 'checked' : '') . '> Normal ';
                echo "<input type='radio' name='respuestas[$i]' value='2' " . ($respuestas[$i] == '2' ? 'checked' : '') . '> Mucho <br><br>';
            }
        ?>
    
        <input type="submit" value="Enviar">
    </form>
```

# Mostrar errores

### Si hay errores, se muestran en una lista con estilo rojo.

```php
    <?php if($errores): ?>
    <div style="color: red;">
        <ul>
            <?php foreach($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
```
# <span style="color:red">Creacion de gráficos de barras en grafico.php</span>

# Procesamiento de datos

### Se verifica si existe el parámetro "envio" en la URL, si existe, se obtienen las respuestas y se almacenan en el array `$respuestas` usando `explode()`, luego se inicializa el array `$data` para las respuestas y se recorren las respuestas incrementando el contador correspondiente en `$data` calculando el total de respuestas.

```php
    <?php if($errores): ?>
    <div style="color: red;">
        <ul>
            <?php foreach($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
```

# Generación del gráfico

### Se definen las etiquetas para las barras y se generan las barras para cada etiqueta, calculando el porcentaje de cada respuesta y mostrando el número de respuestas de cada tipo.

```php
    <div class="bar-container">
        <?php
            // Etiquetas para las barras
            $labels = ['Nada', 'Normal', 'Mucho'];
    
            // Generar las barras
            foreach($labels as $index => $label){
                $percentage = ($total > 0) ? ($data[$index] / $total * 80) : 0;
                echo "<div class='bar' style='width: " . $percentage . "%'>" . $label . ' (' . $data[$index] . ')</div>';
            }
        ?>
    </div>
```

# Estilo CSS para las barras

### Se define el estilo CSS para las barras.

```php
    <style>
        .bar-container {
            margin-top: 20px;
            width:      400px;
            border:     1px solid #ccc;
            font-size:  16px;
        }

        .bar {
            background-color: #007BFF;
            text-align:       center;
            padding:          10px;
            margin-bottom:    5px;
            height: 50px;
        }
    </style>
```