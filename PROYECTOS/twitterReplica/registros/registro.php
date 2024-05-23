<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Mini Twitter</title>
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
<body class="flex items-center justify-center h-screen">
    <div class="w-1/2 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold title mb-6">¡Regístrate en Mini Twitter!</h1>
        <form action="registro_procesar.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
            </div>
            <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrarse</button>
        </form>
        <p class="mt-4 text-sm text-gray-600">¿Ya tienes una cuenta? <a href="../sesiones/iniciar_sesion.php" class="text-purple-500 hover:text-purple-700 font-bold">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
