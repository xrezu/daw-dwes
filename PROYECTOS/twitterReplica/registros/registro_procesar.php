<?php

require_once __DIR__ . '/utils/AppInitializer.php';
require_once __DIR__ . '/utils/db/BaseDatos.php';

AppInitializer::init();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  //Validación de datos de entrada
  if(!empty($username) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)){
    // Verifico si el correo ya está registrado
    $db->ejecuta('SELECT id FROM users WHERE email = ?', $email);

    if($stmt->num_rows > 0){
      echo 'Este correo está asociado a otra cuenta.';
    } else {
      //Hasheamos la pass 
      $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

      $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUE (?, ?, ?)');
      $stmt->bind_param('sss', $username, $email, $hashedPassword);

      if($stmt->execute()){
        echo 'Registro exitoso. Puedes <a href="iniciar_sesion.php">iniciar sesión</a>.';
      } else {
        echo 'Error en el registro. Intenta de nuevo.';
      }
    }

    $stmt->close();
    $conn->close();
  } else {
    echo 'Datos de entrada inválidos.';
  } 
} else {
  echo 'Método de solicitud no válido.';
} 