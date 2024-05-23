<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AppInitializer {
    
    public static function init() {
        // Cargar el autoloader de Composer
        require_once __DIR__ . '/../vendor/autoload.php';
        
        // Iniciar la sesión
        session_start();
        
        // Configurar la conexión a la base de datos
        self::initializeDatabase();
        
        // Configurar PHPMailer
        self::configurePHPMailer();
    }
    
    private static function initializeDatabase() {
        // Incluir la clase BaseDatos
        require_once __DIR__ . '/db.php';
        
        // Obtener la instancia única de la base de datos y inicializarla
        $db = BaseDatos::obtenerInstancia();
        $db->inicializa('mini_twitter', 'root', '1234', 'mysql', 'localhost');
    }
    
    private static function configurePHPMailer() {
        // Configuración de PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_email@gmail.com';
        $mail->Password = 'tu_contraseña';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // Si necesito la instancia de PHPMailer en otro lugar, puedes retornarla o almacenarla en una variable estática
    }
}

?>
