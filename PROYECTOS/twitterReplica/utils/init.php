<?php
//pedimos el autoload.php
require __DIR__ . '/vendor/autoload.php';

session_start();


//Gestión de DB 
define('PATH_DATABASE', 'db/');

spl_autoload_register(function ($clase) {
  require PATH_DATABASE . $clase . '.php';
});

 // Obtener una instancia única de la base de datos e inicializar la conexión
$db = BaseDatos::obtenerInstancia();
$db->inicializa(
    'mini_twitter',
    'root',
    '1234');

session_start();
?>
