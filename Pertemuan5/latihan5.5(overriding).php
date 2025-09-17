<?php

// Kelas Induk
class Dog {
    public function bark() {
        echo "woof <br>";
    }
}

// Kelas Anak
class Hound extends Dog {
    // Overriding method: nama dan parameter sama dengan metode di kelas induk
    public function bark() {
        echo "howl <br>";
    }

    public function sniff() {
        echo "sniff <br>";
    }
}

// Penggunaan
$myDog = new Dog();
$myHound = new Hound();

echo "--- Overriding --- <br>";
$myDog->bark();   // Output: woof
$myHound->bark(); // Output: howl

?>