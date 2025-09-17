<?php
// ==========================
// Class Induk
// ==========================
class Warung {
    public $namaBarang;
    public $harga;

    // Constructor
    public function __construct($namaBarang, $harga) {
        $this->namaBarang = $namaBarang;
        $this->harga = $harga;
    }

    public function informasi() {
        echo "Barang: $this->namaBarang, Harga: Rp $this->harga<br>";
    }
}

// ==========================
// Inheritance + Overriding
// ==========================
class Warung2 extends Warung {
    public $exp;

    public function __construct($namaBarang, $harga, $exp) {
        parent::__construct($namaBarang, $harga); // Panggil constructor kelas induk
        $this->exp = $exp;
    }

    // Overriding
    public function informasi() {
        echo "Barang2: $this->namaBarang, Harga: Rp $this->harga, Kadaluarsa: $this->exp<br>";
    }
}

// ==========================
// Overloading pakai __call()
// ==========================
class Warung3 {
    public function __call($method, $args) {
        if ($method == "total") {
            if (count($args) == 1) {
                return $args[0]; // 1 parameter
            } elseif (count($args) == 2) {
                return $args[0] * $args[1]; // 2 parameter
            } else {
                return 0;
            }
        }
    }
}

// ==========================
// Contoh penggunaan
// ==========================
$barang1 = new Warung("Susu kotak", 6000);
$barang1->informasi();

$barang2 = new Warung2("Yogurt", 12000, "15-10-2025");
$barang2->informasi();

$barang3 = new Warung3();
echo "Harga Indomie setelah diskon: Rp " . $barang3->total(4000) . "<br>";
echo "Harga Telur Rp " . $barang3->total(2000, 5) . "<br>";
?>
