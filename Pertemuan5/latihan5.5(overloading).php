<?php

class Dog {
    // Metode nyata yang akan dipanggil untuk 'overloading'
    public function bark($param = null) {
        if ($param === null) {
            echo "woof <br>";
        } else {
            for ($i = 0; $i < $param; $i++) {
                echo "woof <br>";
            }
        }
    }
}

// Penggunaan
$myDog = new Dog();

echo "--- Overloading (Simulasi) --- <br>";
// Panggilan dengan 0 parameter
$myDog->bark(); 

// Panggilan dengan 1 parameter
$myDog->bark(3);

?>