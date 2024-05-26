<?php

require_once '../utils/AppInitializer.php';
require_once '../utils/db/BaseDatos.php';

// Inicializa la aplicación
AppInitializer::init();

// Obtiene una instancia de la clase BaseDatos
$db = BaseDatos::obtenerInstancia();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validación de datos de entrada
    if (!empty($username) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        // Verificar si el correo ya está registrado
        $db->ejecuta('SELECT id FROM usuarios WHERE correo_electronico = ?', $email);
        if ($db->getExecuted() && $db->obtenDatos(BaseDatos::FETCH_FILA)) {
            echo 'Este correo está asociado a otra cuenta.';
        } else {
            // Hasheamos la contraseña 
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            // Insertar nuevo usuario
            $db->ejecuta('INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)', $username, $email, $hashedPassword);

            if ($db->getExecuted()) {
                echo 'Registro exitoso. Puedes <a href="iniciar_sesion.php">iniciar sesión</a>.';
            } else {
                echo 'Error en el registro. Intenta de nuevo.';
            }
        }
    } else {
        echo 'Datos de entrada inválidos.';
    }
} else {
    echo 'Método de solicitud no válido.';
}

?>
