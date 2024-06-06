<?php
require_once 'db/BaseDatos.php';

$bd = BaseDatos::obtenerInstancia();
$bd->inicializa(__DIR__ . '/resultados.db', null, null, 'sqlite');
?>
