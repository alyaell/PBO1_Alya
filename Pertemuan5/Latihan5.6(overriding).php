<?php
// Kelas Induk
class Hewan {
    public function bersuara() {
        echo "Suara hewan<br>";
    }
}

// Kelas Anak yang menimpa metode dari induknya
class Kucing extends Hewan {
    public function bersuara() {
        echo "Meong<br>";
    }
}

// Penggunaan
$hewan = new Hewan();
$kucing = new Kucing();

echo "--- Contoh Overriding ---<br>";
$hewan->bersuara(); // Output: Suara hewan (dari kelas induk)
$kucing->bersuara(); // Output: Meong (dari kelas anak yang sudah menimpa)
?>