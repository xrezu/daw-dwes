# <span style="color:red">TODO ESTÁ PUESTO EN EL ORDEN QUE DEBERIA IR EN EL CÓDIGO PHP</span>

# <span style="color:red">Parte superior al código HTML es decir el código PhP '<<span hidden="hidden">¿</span>?php ... ?>'</span>

# Inicialización de variables en PhP
### Un Array de nombres de errores y variables para cada una de las variables que se van a validar
```php
    $errores = [];
    $nombre = "";
    $ano = "";
    $mayorDeEdad = false;
    $alergias = [];
```

# Envío de formulario (Validación de envio)
### Aquí dentro irá todo el código de validación de campos y así se valida
```php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Aquí va todo el código de validación de campos
    }
```
### En el formulario se debe poner un input de tipo submit con el nombre de "enviar" para que se pueda validar si se envió el formulario
```html
    <input type="submit" name="enviar" value="Enviar">
```

# Guardar datos del formulario en variables
### Aquí se guardan los datos del formulario en las variables que se van a validar
```php
    $nombre = $_POST["nombre"];
    $mayorDeEdad = $_POST["mayorDeEdad"];
    $ano = "";
```
### En el formulario se debe poner un input con el atributo de "name" para que se pueda guardar el nombre en la variable y un value para que se pueda guardar el valor del input por si se envía el formulario y hay un error
```html
    <label for='nombre'>Nombre:</label><input type='text' name='nombre' id='nombre' value="<?=$nombre?>"><br>

    <label for="vegetariano">¿Eres mayor de edad?</label><input type="checkbox" name="mayorDeEdad" id="mayorDeEdad" <php?=($mayorDeEdad) ? 'checked' : ''?> value="Si"><br>

    <label for='ano'>Año:</label><input type='text' name='ano' id='ano' value="<?=$ano?>"><br><label for="alergias">Alergias:</label>

    <select name="alergias[]" id="alergias" multiple>
    <option value="gluten" <?php=in_array('gluten',$alergias) ? 'selected' : ''?>>Gluten</option>
    <option value="marisco" <?=in_array('marisco',$alergias) ? 'selected' : ''?>>Marisco</option>
    <option value="huevos" <?=in_array('huevos',$alergias) ? 'selected' : ''?>>Huevos</option>
    <option value="pescado" <?=in_array('pescado',$alergias) ? 'selected' : ''?>>Pescado</option>
    <option value="cacahuetes" <?=in_array('cacahuetes',$alergias) ? 'selected' : ''?>>Cacahuetes</option>
    <option value="soja" <?=in_array('soja',$alergias) ? 'selected' : ''?>>Soja</option>
    <option value="lacteos" <?=in_array('lacteos',$alergias) ? 'selected' : ''?>>Lácteos</option>
    <option value="frutossecos" <?=in_array('frutossecos',$alergias) ? 'selected' : ''?>>Frutos Secos</option>
    <option value="apio" <?=in_array('apio',$alergias) ? 'selected' : ''?>>Apio</option>
    <option value="mostaza" <?=in_array('mostaza',$alergias) ? 'selected' : ''?>>Mostaza</option>
    <option value="sesamo" <?=in_array('sesamo',$alergias) ? 'selected' : ''?>>Sésamo</option>
    <option value="sulfiros" <?=in_array('sulfiros',$alergias) ? 'selected' : ''?>>Sulfitos</option>
    <option value="altramuces" <?=in_array('altramuces',$alergias) ? 'selected' : ''?>>Altramuces</option>
    <option value="moluscos" <?=in_array('moluscos',$alergias) ? 'selected' : ''?>>Moluscos</option>
    </select><br>
```

# Validación de campos y guardado de errores
### Aquí se validan los campos y se guardan los errores en el array de errores
```php
    if($nombre === "") {
        $errores["nombre"] = "El nombre es obligatorio";
    }
    
    if($mayorDeEdad === false) {
        $errores["mayorDeEdad"] = "Debes ser mayor de edad";
    }
    
    if($_POST["ano"] > date("Y") || $_POST["ano"] === "") {
        $errores["ano"] = "El año es obligatorio";
    }
    
    $mayorDeEdad = isset($_POST['mayorDeEdad']);
    
    /*isset($_POST['alergias']): Verifica si se ha enviado alguna alergia a través del formulario.
    array_intersect($_POST['alergias'], $alergiasPermitidas): Si se han
    enviado alergias, este código compara el array de alergias enviadas
    ($_POST['alergias']) con el array de alergias permitidas
    ($alergiasPermitidas) y devuelve un nuevo array que contiene solo los
    elementos que están presentes en ambos arrays. Esto garantiza que
    solo se conserven las alergias seleccionadas por el usuario que están
    en la lista de alergias permitidas.*/
    $alergiasPermitidas = ['gluten', 'marisco', 'huevos', 'pescado', 'cacahuetes', 'soja', 'lacteos', 'frutossecos', 'apio', 'mostaza', 'sesamo', 'sulfiros', 'altramuces', 'moluscos'];
    $alergias = isset($_POST['alergias']) ? array_intersect($_POST['alergias'], $alergiasPermitidas) : [];
```
### En el HTML se debe poner encima de cada uno de los inputs un pequeño código PHP para comprobar si el error existe en el array de errores y si existe muestra el mensaje de error correespondiente
```php
    <?php
        if(isset($errores['nombre'])){
            echo "<span class='error'>{$errores['nombre']}</span>";
        }
    ?>
```

# Envío de formulario (Validación de envio)
### Aquí se validará que el array de errores esté vacío y si lo está se redirige a una página de éxito en caso contrario se muestra los errores y se queda en la misma página manteniendo los datos del formulario
```php
    if(empty($errores)){
        header('Location: exito.php');
        die();
    }
```