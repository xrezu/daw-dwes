<?php
session_start();
session_unset();
session_destroy();
header('Location: ../sesiones/iniciar_sesion.php');
exit();
?>
