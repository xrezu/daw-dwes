<?php

define('NUM_POR_PAGINA', 4);

spl_autoload_register(
    function($clase){
        include("$clase.php");
    }
);

$db = BaseDatos::obtenerInstancia();
$db->inicializa(
    'floristeria',   //Base de datos 
    'root',   //Usuario
    '1234'    //Contraseña
);


?>