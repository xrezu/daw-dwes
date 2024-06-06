<?php

spl_autoload_register(function ($class){
  include $class . '.php';
});

$gestores = [
  new GestorRelacional("MySQL", "Base de datos relacional", "Linux, Windows", "8.0", true),
  new GestorNoRelacional("MongoDB", "Base de datos no relacional", "Document"),
  new GestorBasadoEnFichero("CSV Handler", "Gestor basado en ficheros", "CSV", "Lectura y Escritura"),
];

foreach($gestores as $gestor){
  echo $gestor->renderHTML();
}

?>