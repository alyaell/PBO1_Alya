<?php 
class Perulangan { 
    public function looping() { 
        for ($x = 1; $x <= 10; $x++) { 
            echo "$x.<br/>"; // Badan perulangan 
        } 
    } 
} 

// bikin objek dari class
$obj = new Perulangan(); 
// panggil method looping
$obj->looping(); 
?>
