
<?php
/* Desarrolla un script que genere un array con 100 números aleatorios y luego los ordene de menor a mayor.*/
$array = [];
for ($i = 0; $i < 100; $i++) {
    $array[] = rand(1, 101);
}

sort($array);
?>
<html>
<?php
foreach ($array as $value) {
    echo $value . "<br>";
}
?>
</html>