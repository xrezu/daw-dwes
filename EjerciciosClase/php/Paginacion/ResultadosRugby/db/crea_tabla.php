<?php
require '../config.php';

$bd->ejecuta('
    CREATE TABLE IF NOT EXISTS resultados (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        contrincante TEXT NOT NULL,
        lugar VARCHAR(255) NOT NULL,
        resultado_a INT NOT NULL,
        resultado_b INT NOT NULL
    )
');

echo "Tabla 'resultados' creada correctamente.";
?>
