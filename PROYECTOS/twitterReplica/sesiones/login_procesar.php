<?php
require_once '../utils/AppInitializer.php';
require_once '../utils/db/BaseDatos.php';

// Inicializamos la app y declaramos una instancia de la clase BaseDatos
AppInitializer::init();
$db = BaseDatos::obtenerInstancia();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar el correo electrónico
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // Sanitizar la contraseña
    $password = htmlspecialchars(trim($_POST['password']));

    // Verificar si se ha marcado la opción "Recuérdame"
    $remember = isset($_POST['remember']);

    if (!empty($email) && !empty($password)) {
        // Query para buscar al usuario en la bbdd por su correo electrónico
        $db->ejecuta('SELECT id, contrasena FROM usuarios WHERE correo_electronico = ?', $email);
        
        $usuario = $db->obtenDatos(BaseDatos::FETCH_FILA);

        // Si encontramos usuario:
        if ($usuario && password_verify($password, $usuario['contrasena'])) {
            // Verificamos la contraseña y redirigimos a la página de inicio
            $_SESSION['user_id'] = $usuario['id'];

            if ($remember) {
                // Generar un token único
                $token = bin2hex(random_bytes(16));
                $expira = time() + (86400 * 3); // 3 días

                // Guardar el token en la base de datos
                $db->ejecuta('INSERT INTO tokens (token, usuario_id, f
                echa_validez) VALUES (?, ?, ?)', $token, $usuario['id'], date('Y-m-d H:i:s', $expira));

                // Guardar el token en una cookie
                setcookie('remember_token', $token, $expira, "/");
            }

            header('Location: ../dashboard.php');
            exit();
        } else {
            echo 'Correo electrónico o contraseña incorrectos.';
        }
    } else {
        echo 'Datos de entrada no válidos.';
    }
} else {
    echo 'Método de solicitud no válido.';
}
?>
