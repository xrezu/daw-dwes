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
$db->ejecuta('SELECT nombre_usuario, foto_perfil FROM usuarios WHERE id = ?', $user_id);
$usuario = $db->obtenDatos(BaseDatos::FETCH_FILA);

// Paginación
$elementos_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $elementos_por_pagina;

// Obtener el número total de textos
$db->ejecuta('SELECT COUNT(*) AS total FROM textos');
$total_textos = $db->obtenDatos(BaseDatos::FETCH_FILA)['total'];
$total_paginas = ceil($total_textos / $elementos_por_pagina);

// Obtener textos paginados de todos los usuarios ordenados por fecha de creación
$db->ejecuta('SELECT textos.contenido, usuarios.nombre_usuario, usuarios.foto_perfil, usuarios.id AS usuario_id 
              FROM textos 
              INNER JOIN usuarios ON textos.usuario_id = usuarios.id 
              ORDER BY textos.fecha_creacion DESC 
              LIMIT ? OFFSET ?', $elementos_por_pagina, $offset);
$textos = $db->obtenDatos(BaseDatos::FETCH_TODOS);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Mini Twitter</title>
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
    <h1 class="text-3xl font-bold title mb-6 flex items-center">
      <a href="ver_perfil.php?id=<?php echo $user_id; ?>"><img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de Perfil" class="h-8 w-8 rounded-full mr-2"></a>
      Bienvenido, <a href="ver_perfil.php?id=<?php echo $user_id; ?>" class="hover:underline"><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></a>!
    </h1>
    <div class="mb-6">
      <a href="perfil.php?id=<?php echo $user_id; ?>" class="text-purple-500 hover:text-purple-700 font-bold">Editar Perfil</a>
    </div>
    <!-- Formulario para publicar texto -->
    <form action="utils/publicar_textos.php" method="POST" class="mb-6 w-full">
      <div class="flex items-center mb-4">
        <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de Perfil" class="h-8 w-8 rounded-full mr-2">
        <textarea name="texto" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" placeholder="¿Qué estás pensando?" required></textarea>
      </div>
      <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Publicar</button>
    </form>
    <div class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Todos los Textos:</h2>
      <?php if (empty($textos)) : ?>
        <p class="text-gray-700">No hay textos disponibles.</p>
      <?php else : ?>
        <ul>
          <?php foreach ($textos as $texto) : ?>
            <li class="bg-gray-100 p-4 rounded-lg mb-4 shadow-md flex items-center">
              <a href="ver_perfil.php?id=<?php echo $texto['usuario_id']; ?>"><img src="<?php echo htmlspecialchars($texto['foto_perfil']); ?>" alt="Foto de Perfil" class="h-8 w-8 rounded-full mr-2"></a>
              <strong><a href="ver_perfil.php?id=<?php echo $texto['usuario_id']; ?>" class="hover:underline"><?php echo htmlspecialchars($texto['nombre_usuario']); ?></a>:</strong>
              <?php echo htmlspecialchars($texto['contenido']); ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="flex justify-between mt-4">
          <?php if ($pagina_actual > 1) : ?>
            <a href="?pagina=<?php echo $pagina_actual - 1; ?>" class="text-purple-500 hover:text-purple-700">Anterior</a>
          <?php endif; ?>
          <?php if ($pagina_actual < $total_paginas) : ?>
            <a href="?pagina=<?php echo $pagina_actual + 1; ?>" class="text-purple-500 hover:text-purple-700 ml-auto">Siguiente</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="mt-6">
      <a href="utils/logout.php" class="text-purple-500 hover:text-purple-700 font-bold">Cerrar Sesión</a>
    </div>
  </div>
</body>
</html>
