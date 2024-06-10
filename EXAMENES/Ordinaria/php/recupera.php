<?php
    require "funciones.php";

    $errores = [];
    $cambio_pass_exitoso = false;

    if(!isset($_GET['token']) || empty($_GET['token'])) {
        header("Location: recupera_listado.php");
        die();
    } else {
        $token = $_GET['token'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nueva_pass = isset($_POST['nueva_pass']) ? trim($_POST['nueva_pass']) : null;

            if(empty($nueva_pass)){
                $errores['nueva_pass'] = "Debes introducir una contraseña";
            } else if (validarNuevaContrasena($token, $nueva_pass)){
                $errores['nueva_pass'] = "La contraseña no puede ser la misma";
            }

            if(empty($errores)){
                actualizarPass($token, $nueva_pass);
                $cambio_pass_exitoso = true;

                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 2500);
                        </script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera la contraseña</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <?php if(isset($cambio_contrasena_exitoso) && $cambio_contrasena_exitoso): ?>
        <span class="exito"> Contraseña cambiada con éxito </span>
    <?php endif; ?>
    <!-- formulario para recuperar contraseña -->
    <form action="" method="post">
        <label for="nueva_pass">Nueva contraseña:</label> <br>
        <input type="text" name="nueva_pass">
        <?php if (isset($errores["nueva_pass"])): ?>
            <span class="error"><?= $errores["nueva_pass"] ?></span>
        <?php endif; ?> <br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>