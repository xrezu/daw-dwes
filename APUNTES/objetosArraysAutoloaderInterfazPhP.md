# <span style="color:red">ESTOS SON ARCHIVOS INDIVIDUALES, EL ORDEN ES REPRESENTATIVO</span>

# <span style="color:red">Parte superior al código HTML es decir el código PhP '<<span hidden="hidden">¿</span>?php ... ?>'</span>

# Autoloader.php
### Dentro de este archivo se creará una función que se encargará de cargar las clases automáticamente
```php
<?php

    spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });
```

# IAlerta.php
### Dentro de este archivo se introducira una interfaz que se encargará de implementar una función mostrar() y que será implementada por AlertaBase.php y que a su vez será extendida por AlertaWarning.php, AlertaError.php y AlertaAlarma.php
```php
<?php

    interface IAlerta {
        public function mostrar();
    }
```

# AlertaBase.php
### Dentro de este archivo se implementará una clase abstracta que implementará la interfaz IAlerta con un constructor que recibirá un título y un mensaje
```php
<?php

    abstract class AlertaBase implements IAlerta {
        protected $titulo;
        protected $mensaje;

        public function __construct($titulo, $mensaje) {
            $this->titulo = $titulo;
            $this->mensaje = $mensaje;
        }
    }
```

# AlertaWarning.php
### Dentro de este archivo se implementará una clase que extenderá de AlertaBase y se encargará de mostrar un mensaje de alerta de tipo Warning
```php
<?php

    class AlertaWarning extends AlertaBase {
        public function mostrar() {
            return "<div class='alert-warning'><strong>!</strong> {$this->titulo}: {$this->mensaje}</div>";
        }
    }
```

# AlertaError.php
### Dentro de este archivo se implementará una clase que extenderá de AlertaBase y se encargará de mostrar un mensaje de alerta de tipo Error
```php
<?php

    class AlertaError extends AlertaBase {
        public function mostrar() {
            return "<div class='alert-error'><strong>X</strong> {$this->titulo}: {$this->mensaje}</div>";
        }
    }
```

# AlertaAlarma.php
### Dentro de este archivo se implementará una clase que extenderá de AlertaBase y se encargará de mostrar un mensaje de alerta de tipo Alarma
```php
<?php

    class AlertaAlarma extends AlertaBase {
        public function mostrar() {
            return "<script>alert('{$this->titulo}: {$this->mensaje}');</script>";
        }
    }
```

# AlertaManager.php
### Dentro de este archivo se implementará una clase que se encargará de agregar alertas a un array y mostrarlas
```php
<?php

    class AlertaManager
    {
        private $alertas = [];

        public function agregarAlerta($tipo, $titulo, $mensaje)
        {
            try{
                $alerta = AlertaFactory::crearAlerta($tipo, $titulo, $mensaje);
                $this->alertas[] = $alerta;
            }catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function mostrarAlertas()
        {
            foreach($this->alertas as $alerta){
                echo $alerta->mostrar();
            }
        }
    }
```

# AlertaFactory.php
### Dentro de este archivo se implementará una clase que se encargará de crear alertas de acuerdo a un tipo específico (Warning, Error, Alarma)
```php
<?php

    class AlertaFactory {
        public static function crearAlerta($tipo, $titulo, $mensaje) {
            $nombreClase = "Alerta{$tipo}";
            if (class_exists($nombreClase)) {
                return new $nombreClase($titulo, $mensaje);
            } else {
                throw new Exception("Tipo de alerta no válido: {$tipo}");
            }
        }
    }
```

# index.php
### Dentro de este archivo se instanciará un objeto de la clase AlertaManager y se agregarán 10 alertas de tipo Warning, Error y Alarma, se mostrarán las alertas de forma aleatoria
```php
<?php

    require_once 'Autoloader.php';

    $tipos = ['Warning', 'Error', 'Alarma'];
    $titulos = ['Fallo', 'Error', 'Fiasco', 'Alerta', 'Problema', 'Incidencia', 'Incidente', 'Peligro', 'Atención', 'Advertencia'];
    $mensajes = ['Esto es Horrible', 'La has cagado', 'NOOOOOOO', '¿Que haces?', '¡Cuidado!', 'Estas despedido seguro', '¡Detente!', 'Llama al Senior', 'Necesitamos ayuda', 'Esto no está bien'];
    const CANTIDAD = 10;


    $alertaManager = new AlertaManager();

    for ($i = 0; $i < CANTIDAD; $i++) {
        $tipo = $tipos[array_rand($tipos)];
        $titulo = $titulos[array_rand($titulos)];
        $mensaje = $mensajes[array_rand($mensajes)];

        $alertaManager->agregarAlerta($tipo, $titulo, $mensaje);
    }

    $alertaManager->mostrarAlertas();

?>
```

```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Alertas</title>
        <link rel='stylesheet' href='estilos.css'>
    </head>
    <body>
    </body>
    </html>
```
