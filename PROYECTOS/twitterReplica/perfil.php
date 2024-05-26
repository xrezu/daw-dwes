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

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Obtener los datos del usuario
$db->ejecuta('SELECT nombre_usuario, biografia, correo_electronico, foto_perfil FROM usuarios WHERE id = ?', $user_id);
$usuario = $db->obtenDatos(BaseDatos::FETCH_FILA);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil - Mini Twitter</title>
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
    <h1 class="text-3xl font-bold title mb-6">Perfil de Usuario</h1>
    <div class="mb-6">
      <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de Perfil" class="h-24 w-24 rounded-full mx-auto mb-4">
      <form action="utils/actualizar_perfil.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
          <label class="block text-gray-700">Nombre de Usuario:</label>
          <input type="text" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Biografía:</label>
          <textarea name="biografia" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500"><?php echo htmlspecialchars($usuario['biografia']); ?></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Correo Electrónico:</label>
          <input type="email" name="correo_electronico" value="<?php echo htmlspecialchars($usuario['correo_electronico']); ?>" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Foto de Perfil:</label>
          <input type="text" name="foto_perfil" value="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500">
        </div>
        <button type="submit" class="mt-2 bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar Perfil</button>
      </form>
    </div>
    <div class="mt-6">
      <a href="dashboard.php" class="text-purple-500 hover:text-purple-700 font-bold">Volver al Dashboard</a>
    </div>
  </div>
</body>
</html>
