<?php
require '../config.php';

// Iniciar la transacción
$bd->ejecuta('BEGIN TRANSACTION');

try {
  for ($i = 1; $i <= 30; $i++) {
    $contrincante = "Equipo $i";
    $lugar = "Lugar $i";
    $resultado_a = rand(0, 50); // Generar un resultado aleatorio para España
    $resultado_b = rand(0, 50); // Generar un resultado aleatorio para el contrincante

    $bd->ejecuta(
      'INSERT INTO resultados (contrincante, lugar, resultado_a, resultado_b) VALUES (?, ?, ?, ?)', 
      [$contrincante, $lugar, $resultado_a, $resultado_b]
    );
  }
  // Confirmar la transacción
  $bd->ejecuta('COMMIT');
  echo "Datos insertados correctamente.";
} catch (Exception $e) {
  // Revertir la transacción en caso de error
  $bd->ejecuta('ROLLBACK');
  echo "Hubo un error al insertar los datos: " . $e->getMessage();
}
?>
