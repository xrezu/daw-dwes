<?php
session_start(); 
include 'funciones.php';

global $db; 

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = isset($_POST['email']) ? trim($_POST['email']) : null;
  $password = isset($_POST['password']) ? $_POST['password'] : null;

  if (empty($email) || empty($password)) {
    $errores['login'] = 'Email y contraseña son obligatorios';
  } else {
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $db->ejecuta($sql, [$email]);
    $usuario = $db->obtenDatos(BaseDatos::FETCH_FILA);

    if ($usuario && password_verify($password, $usuario['pass'])) {
      $_SESSION['usuario_id'] = $usuario['id'];
      header('Location: pedidos.php');
      exit();
    } else {
      $errores['login'] = 'Credenciales inválidas';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <?php if (isset($errores['login'])) : ?>
        <p style="color:red;"><?= $errores['login'] ?></p>
    <?php endif; ?>
</body>
</html>
