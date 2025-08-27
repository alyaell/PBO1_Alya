<?php
// Latihan 2.4 - Operator Logika

$x = 100;
$y = 50;

// AND
if ($x == 100 and $y == 50) {
    echo "Hello world and!";
}
echo "<br>";

// OR
if ($x == 100 or $y == 80) {
    echo "Hello world or!";
}
echo "<br>";

// &&
if ($x == 100 && $y <= 50) {
    echo "Hello world &&!";
}
echo "<br>";

// ||
if ($x == 100 || $y == 80) {
    echo "Hello world ||!";
}
echo "<br>";

// NOT
if ($x !== 100) {
    echo "Hello world not!";
}
echo "<br>";
?>
