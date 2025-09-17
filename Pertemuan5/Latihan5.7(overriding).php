<?php
class testParent {
    public function f1() {
        echo "echo 1 <br>";
    }

    // Metode induk dengan parameter opsional
    public function f2($sa = null) {
        if ($sa === null) {
            echo "echo 2 <br>";
        } else {
            echo "Induk: " . $sa . "<br>";
        }
    }
}

class testChild extends testParent {
    // Metode anak dengan parameter opsional yang sama persis
    // Ini memperbaiki kesalahan kompatibilitas
    public function f2($sa = null) {
        if ($sa === null) {
            echo "Anak: Tidak ada parameter<br>";
        } else {
            echo "Anak: " . $sa . "<br>";
        }
    }
}

// Penggunaan
$parentObj = new testParent();
$childObj = new testChild();

echo "--- Pemanggilan dari Kelas Induk ---<br>";
$parentObj->f2(); // Panggil tanpa parameter
$parentObj->f2("halo"); // Panggil dengan parameter

echo "--- Pemanggilan dari Kelas Anak ---<br>";
$childObj->f2(); // Panggil tanpa parameter
$childObj->f2("ankur"); // Panggil dengan parameter
?>