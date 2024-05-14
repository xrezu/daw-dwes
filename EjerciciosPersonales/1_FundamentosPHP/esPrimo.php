<?php
$esPrimo = true;

if (isset($_GET['numero'])){
  $numero = $_GET['numero']; // Recogemos el número introducido por el usuario
  if ($numero == 1) { // El 1 no es primo
      $esPrimo = false;
  } elseif ($numero > 1) { // Si el número es mayor que 1
      for ($i = 2; $i < $numero; $i++) { // Bucle que recorre los números desde el 2 hasta el número anterior al introducido
          if ($numero % $i == 0) { // Si el número es divisible por alguno de los números del bucle
              $esPrimo = false; // No es primo
              break;
          }
      }
  } else {
      $esPrimo = false; // Cualquier número menor que 1 no es primo
  }
}
?>

<html>
<h1>Introduce un numero para saber si es primo</h1>
<form action="esPrimo.php" method="get">
<input type="number" name="numero">
<button type="submit">Comprobar</button>
</form>
<?= $esPrimo ? "<h3>El numero $numero es primo</h3>" : "<h3>El numero $numero no es primo</h3>" ?>
</html>