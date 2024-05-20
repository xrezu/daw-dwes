<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1 {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
        $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : '';
        $platos = isset($_GET['platos']) ? $_GET['platos'] : '';

        $fecha_actual = date('Y-m-d');
        $dias_laborales = 0;
        $fecha_entrega = strtotime($fecha_actual);
        while ($dias_laborales < 7) {
            // Incrementar la fecha en un día
            $fecha_entrega = strtotime('+1 day', $fecha_entrega);
            // Verificar si el día es laboral (no es sábado ni domingo)
            if (date('N', $fecha_entrega) <= 5) {
                $dias_laborales++;
            }
        }
        $fecha_entrega_formateada = date('Y-m-d', $fecha_entrega);

        echo "<h1>¡Pedido Confirmado!</h1>";
        echo "<p>Estimado(a) $nombre, tu pedido de $platos platos será entregado en la siguiente dirección: $direccion.</p>";
        echo "<p>Los platos llegarán el $fecha_entrega_formateada.</p>";
        ?>
    </div>
</body>
</html>
