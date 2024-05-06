<?php
/* Desarrolla una calculadora básica que permita sumar, restar, multiplicar y dividir dos números. */

$operacion = "";
$resultado = 0;

if (isset($_GET['numero1']) && isset($_GET['numero2']) && isset($_GET['operacion'])) {
    $numero1 = $_GET['numero1'];
    $numero2 = $_GET['numero2'];
    $operacion = $_GET['operacion'];

    switch ($operacion) {
        case "sumar":
            $resultado = $numero1 + $numero2;
            break;
        case "restar":
            $resultado = $numero1 - $numero2;
            break;
        case "multiplicar":
            $resultado = $numero1 * $numero2;
            break;
        case "dividir":
            $resultado = $numero1 / $numero2;
            break;
    }
}
?>
<html>
<h1>Calculadora</h1>
<form action="calculadora.php" method="get">
    <input type="number" name="numero1">
    <select name="operacion">
        <option value="sumar">+</option>
        <option value="restar">-</option>
        <option value="multiplicar">*</option>
        <option value="dividir">/</option>
    </select>
    <input type="number" name="numero2">
    <button type="submit">Calcular</button>
</form>
<h2>Resultado: <?= $resultado ?></h2>
</html>
