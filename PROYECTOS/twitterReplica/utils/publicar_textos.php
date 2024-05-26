<?php
require_once 'AppInitializer.php';
require_once 'db/BaseDatos.php';

session_start();

//verificación de q la sesión esté iniciada 
if(!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  AppInitializer::init();
  $db = BaseDatos::obtenerInstancia();

  //cogemos el id y trimeamos el texto 
  $user_id = $_SESSION['user_id'];
  $texto = trim($_POST['texto']);

  //comprobamos si la var texto no está vacía, sino insertamos el nuevo texto. 
  if (!empty($texto)) {
    $db->ejecuta('INSERT INTO textos (usuario_id, contenido, fecha_creacion) VALUES (?, ?, NOW())', $user_id, $texto);
  }
  header('Location: ../dashboard.php');
  exit();
} else {
  header('Location: ../dashboard.php');
  exit();
}
?>