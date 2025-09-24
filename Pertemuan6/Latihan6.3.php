<?php

class KonversiSuhu {
    private $suhuCelsius;
    private $hasilKonversi;

    // 5. Tambahkan constructor
    public function __construct($celsius) {
        $this->suhuCelsius = $celsius;
        $this->hitungKonversi();
    }

    private function hitungKonversi() {
        // 2. Tambahkan deklarasi array untuk menyimpan hasil
        $this->hasilKonversi = [
            'Celcius' => $this->suhuCelsius,
            'Reamur' => ($this->suhuCelsius * 4 / 5),
            'Fahrenheit' => ($this->suhuCelsius * 9 / 5) + 32,
            'Kelvin' => $this->suhuCelsius + 273.15
        ];
    }

    public function tampilkanHasil() {
        echo "<h2>Konversi Suhu dari Celcius</h2>";

        // 3. Tambahkan perulangan
        foreach ($this->hasilKonversi as $unit => $nilai) {
            echo "suhu dalam " . strtolower($unit) . " = " . number_format($nilai, 2) . " derajat<br>";
        }

        echo "<br>Sekian konversi suhu yang bisa dilakukan";
    }
}

// 1. Inputkan get
// 4. Tambahkan percabangan
if (isset($_GET['celcius']) && is_numeric($_GET['celcius'])) {
    $suhuInput = $_GET['celcius'];
    $konverter = new KonversiSuhu($suhuInput);
    $konverter->tampilkanHasil();
} else {
    echo "Silakan masukkan suhu Celcius di URL. Contoh: `http://localhost/latihan.php?celcius=36`";
}

?>