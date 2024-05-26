<?php
require_once 'utils/AppInitializer.php';
require_once 'utils/db/BaseDatos.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

// Inicializamos la app y declaramos una instancia de la clase BaseDatos
AppInitializer::init();
$db = BaseDatos::obtenerInstancia();

// Obtener el ID del usuario cuyo perfil queremos ver
$usuario_id = $_GET['id'];

// Obtener los datos del usuario
$db->ejecuta('SELECT nombre_usuario, biografia, correo_electronico, foto_perfil FROM usuarios WHERE id = ?', $usuario_id);
$usuario = $db->obtenDatos(BaseDatos::FETCH_FILA);

// Si el usuario no existe, redirigir al dashboard
if (!$usuario) {
  header('Location: dashboard.php');
  exit();
}

// Verificar si el usuario actual es el propietario del perfil
$es_mi_perfil = ($usuario_id == $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de Usuario - Mini Twitter</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #FCE7F3;
    }

    .title {
      color: #FF6B6B;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen">
  <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg mt-10">
    <h1 class="text-3xl font-bold title mb-6">Perfil de <?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h1>
    <div class="mb-6">
      <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de Perfil" class="h-24 w-24 rounded-full mx-auto mb-4">
      <div class="mb-4">
        <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($usuario['nombre_usuario']); ?></p>
      </div>
      <div class="mb-4">
        <p><strong>Biografía:</strong> <?php echo htmlspecialchars($usuario['biografia']); ?></p>
      </div>
      <div class="mb-4">
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($usuario['correo_electronico']); ?></p>
      </div>
      <?php if ($es_mi_perfil) : ?>
        <div class="mt-6">
          <a href="perfil.php" class="text-purple-500 hover:text-purple-700 font-bold">Editar Perfil</a>
        </div>
      <?php endif; ?>
    </div>
    <div class="mt-6">
      <a href="dashboard.php" class="text-purple-500 hover:text-purple-700 font-bold">Volver al Dashboard</a>
    </div>
  </div>
</body>
</html>
