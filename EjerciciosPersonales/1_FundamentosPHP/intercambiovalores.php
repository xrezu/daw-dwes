<?php

/*Crea un script que intercambie los valores de dos variables sin usar una tercera variable.*/ 
$var1 = 5;
$var2 = 1;

echo "<h1>Antes del intercambio: var1 = $var1 y var2 = $var2 <br> </h1>";

$var1 = $var1 + $var2;
$var2 = $var1 - $var2;
$var1 = $var1 - $var2;

echo "<h1> Después del intercambio: var1 = $var1 y var2 = $var2 </h1>";

?>