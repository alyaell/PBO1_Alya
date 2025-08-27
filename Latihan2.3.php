<?php
// Latihan 2.3 - Operator Perbandingan

echo "<h3>Latihan 2.3</h3>";

// Contoh 1: Tidak sama dengan (!=)
$x = 5;
$y = 10;
echo "\$x = 5; \$y = 10; Hasil (x != y) = ";
var_dump($x != $y);
echo "<br>";

// Contoh 2: Tidak identik (!==)
$x = 10;
$y = 10;
echo "\$x = 10; \$y = 10; Hasil (x !== y) = ";
var_dump($x !== $y);
echo "<br>";

// Contoh 3: Sama dengan (==)
$x = 16;
$y = 10;
echo "\$x = 16; \$y = 10; Hasil (x == y) = ";
var_dump($x == $y);
echo "<br>";

// Contoh 4: Identik (===)
$x = 6;
$y = 6;
echo "\$x = 6; \$y = 6; Hasil (x === y) = ";
var_dump($x === $y);
echo "<br>";

// Contoh 5: Operator Spaceship (<=>)
$x = 15;
$y = 10;
echo "\$x = 15; \$y = 10; Hasil (x <=> y) = " . ($x <=> $y) . "<br>";
?>
