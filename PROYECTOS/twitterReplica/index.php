<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
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
    <div class="text-center">
        <h1 class="text-4xl font-bold title mb-8">¡Bienvenido a Mini Twitter!</h1>
        <p class="text-lg text-gray-700 mb-8">Regístrate o inicia sesión para comenzar.</p>
        <div class="space-x-4">
            <a href="registros/registro.php" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">Registrarse</a>
            <a href="iniciar_sesion.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>
