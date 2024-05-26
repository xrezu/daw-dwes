<?php
require_once 'AppInitializer.php';
require_once 'db/BaseDatos.php';

session_start();

// Verificación de que la sesión esté iniciada
if (!isset($_SESSION['user_id'])) {
  header('Location: ../sesiones/login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  AppInitializer::init();
  $db = BaseDatos::obtenerInstancia();

  // Obtener el ID del usuario de la sesión
  $user_id = $_SESSION['user_id'];

  // Obtener y sanitizar los datos del formulario
  $nombre_usuario = trim($_POST['nombre_usuario']);
  $biografia = trim($_POST['biografia']);
  $correo_electronico = trim($_POST['correo_electronico']);
  $foto_perfil = trim($_POST['foto_perfil']);

  // Actualizar la base de datos
  if ($foto_perfil) {
    $db->ejecuta('UPDATE usuarios SET nombre_usuario = ?, biografia = ?, correo_electronico = ?, foto_perfil = ? WHERE id = ?', $nombre_usuario, $biografia, $correo_electronico, $foto_perfil, $user_id);
  } else {
    $db->ejecuta('UPDATE usuarios SET nombre_usuario = ?, biografia = ?, correo_electronico = ? WHERE id = ?', $nombre_usuario, $biografia, $correo_electronico, $user_id);
  }

  header('Location: ../perfil.php');
  exit();
} else {
  header('Location: ../perfil.php');
  exit();
}
?>
