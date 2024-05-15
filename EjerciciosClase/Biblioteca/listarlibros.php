<?php
// Incluir archivo de conexión
include 'conexion.php';

try {
    // Consulta SQL para seleccionar libros publicados después del año 2000
    $sql = "SELECT * FROM libros WHERE ano_publicacion > 2000";
    // Preparar consulta
    $stmt = $conn->prepare($sql);
    // Ejecutar consulta
    $stmt->execute();
    // Obtener resultados
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar resultados
    echo "<h2>Libros publicados después del año 2000:</h2>";
    foreach ($libros as $libro) {
        echo "Título: " . $libro['titulo'] . "<br>";
        echo "Autor: " . $libro['autor'] . "<br>";
        echo "Año de publicación: " . $libro['ano_publicacion'] . "<br><br>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
