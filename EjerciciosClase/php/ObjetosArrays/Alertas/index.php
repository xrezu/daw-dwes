<?php

//Configuro el autoload para las clases creadas
spl_autoload_register(function ($classname){
  include 'clases/' . $classname . '.php';
});

function generarAlertaAleatoria($i){
  $tipos = ['AlertaWarning','AlertaError','AlertaAlarma'];
  $tipo = $tipos[array_rand($tipos)];
  return new $tipo("Titulo de $tipo número $i", "Mensaje de $tipo");
}

?>

<html>
  <body>
  <?php
    for ($i=0; $i < 10; $i++) { 
      $alerta = generarAlertaAleatoria($i);
      $alerta->mostrar();
    }
  ?>
  </body>
</html>