<?php
// Parent Class
class Kendaraan {
    public $merek;
    public $harga;

    public function __construct($merek, $harga) {
        $this->merek = $merek;
        $this->harga = $harga; // harga dalam juta
    }
}

// Child Class
class Pesawat extends Kendaraan {
    private $tinggiMaks;       // feet
    private $kecepatanMaks;    // km/jam

    // Setter
    public function setTinggiMaks($tinggi) {
        $this->tinggiMaks = $tinggi;
    }

    public function setKecepatanMaks($kecepatan) {
        $this->kecepatanMaks = $kecepatan;
    }

    // Getter
    public function bacaTinggiMaks() {
        return $this->tinggiMaks;
    }

    public function bacaKecepatanMaks() {
        return $this->kecepatanMaks;
    }

    // Hitung biaya operasional
    public function biayaOperasional() {
        $hargaRupiah = $this->harga * 1000000; // konversi juta ke rupiah
        $tinggi = $this->tinggiMaks;
        $kecepatan = $this->kecepatanMaks;

        if ($tinggi > 5000 && $kecepatan > 800) {
            $biaya = 0.3 * $hargaRupiah;
        } elseif ($tinggi >= 3000 && $tinggi <= 5000 && $kecepatan >= 500 && $kecepatan <= 800) {
            $biaya = 0.2 * $hargaRupiah;
        } elseif ($tinggi < 3000 && $kecepatan < 500) {
            $biaya = 0.1 * $hargaRupiah;
        } else {
            $biaya = 0.05 * $hargaRupiah;
        }

        return $biaya;
    }

    // Tampilkan info pesawat
    public function infoPesawat() {
        $biaya = number_format($this->biayaOperasional(), 0, ',', '.');
        $hargaRp = number_format($this->harga * 1000000, 0, ',', '.');
        echo "Biaya operasional pesawat '{$this->merek}' dengan harga Rp $hargaRp yang memiliki tinggi maksimum {$this->tinggiMaks} feet dan kecepatan maksimum {$this->kecepatanMaks} km/jam adalah Rp $biaya.<br><br>";
    }
}

// === Main Program ===
$pesawat1 = new Pesawat("Boeing 737", 2000);
$pesawat1->setTinggiMaks(7500);
$pesawat1->setKecepatanMaks(650);
$pesawat1->infoPesawat();

$pesawat2 = new Pesawat("Boeing 747", 3500);
$pesawat2->setTinggiMaks(5800);
$pesawat2->setKecepatanMaks(750);
$pesawat2->infoPesawat();

$pesawat3 = new Pesawat("Cassa", 750);
$pesawat3->setTinggiMaks(3500);
$pesawat3->setKecepatanMaks(550);
$pesawat3->infoPesawat();
?>
