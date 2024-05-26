<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Mini Twitter</title>
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
        <h1 class="text-3xl font-bold title mb-6">Inicia Sesión en Mini Twitter</h1>
        <form action="login_procesar.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-purple-500" required>
            </div>
            <div class="mb-4">
                <input type="checkbox" id="remember" name="remember" class="mr-2 leading-tight">
                <label for="remember" class="text-gray-700 font-bold">Recuérdame</label>
            </div>
            <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Iniciar Sesión</button>
        </form>
        <p class="mt-4 text-sm text-gray-600">¿No tienes una cuenta? <a href="registro.php" class="text-purple-500 hover:text-purple-700 font-bold">Regístrate aquí</a></p>
        <p class="mt-4 text-sm text-gray-600">¿Olvidaste tu contraseña? <a href="restablecer_solicitar.php" class="text-purple-500 hover:text-purple-700 font-bold">Restablecer contraseña</a></p>
    </div>
</body>
</html>
