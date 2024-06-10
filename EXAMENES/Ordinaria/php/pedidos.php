<?php

require 'funciones.php';

verificarSesion();

//Parámetros de paginación
$porPagina = 5;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $porPagina;

//Total de pedidos mediante funcion
$totalPedidos = obtenerNumPedidos();
$totalPaginas = ceil($totalPedidos/ $porPagina);

//Obtener el listado de pedidos con paginación 
$pedidos = obtenerPedidos($offset, $porPagina);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
    <h2>Listado de Pedidos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Flor</th>
            <th>Dirección</th>
            <th>Fecha</th>
            <th>Unidades</th>
        </tr>
        <?php foreach ($pedidos as $pedido) : ?>
        <tr>
            <td><?= $pedido['id'] ?></td>
            <td><?= $pedido['flor'] ?></td>
            <td><?= $pedido['direccion'] ?></td>
            <td><?= $pedido['fecha'] ?></td>
            <td><?= $pedido['unidades'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div>
        <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
            <a href="?pagina=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>