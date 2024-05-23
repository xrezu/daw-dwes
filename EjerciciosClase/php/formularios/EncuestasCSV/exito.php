<?php
session_start();

if(!isset($_SESSION['nombre'])){
  //Si no tenemos nombre en la sesión redirigimos de nuevo a encuesta
  header("Location: encuesta.php");
  exit();
}

$nombre = $_SESSION['nombre'];

echo "<h1>¡Gracias por completar la encuesta, $nombre!</h1>";

//limpiamos el nombre de la sesión después de usarlo

unset($_SESSION['nombre']);
?>