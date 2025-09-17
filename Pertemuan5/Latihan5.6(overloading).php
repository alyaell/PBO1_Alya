<?php
class Kalkulator {
    // Metode magis yang menangani semua panggilan metode yang tidak terdefinisi
    public function __call($namaMetode, $argumen) {
        if ($namaMetode == 'tambah') {
            // Logika untuk menambahkan
            if (count($argumen) == 2) {
                return $argumen[0] + $argumen[1];
            } elseif (count($argumen) == 3) {
                return $argumen[0] + $argumen[1] + $argumen[2];
            }
        }
    }
}

// Penggunaan
$calc = new Kalkulator();

echo "--- Contoh Simulasi Overloading ---<br>";
echo "Hasil penambahan 2 angka: " . $calc->tambah(5, 10) . "<br>";
echo "Hasil penambahan 3 angka: " . $calc->tambah(5, 10, 15) . "<br>";
?>