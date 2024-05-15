<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "biblioteca";

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión establecida correctamente";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
