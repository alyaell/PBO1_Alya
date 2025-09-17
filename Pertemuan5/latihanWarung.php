<?php
class Warung {
    public $barang;

    // Constructor
    public function __construct($barang) {
        $this->barang = $barang;
    }

    public function menampilkanBarang() {
        foreach ($this->barang as $namaBarang => $harga) {
            echo "- $namaBarang dengan harga Rp $harga <br>";
        }
    }
}

$barang = [
    "Kecap" => 3000,
    "Tepung Terigu" => 4000
];

// Membuat objek
$barang1 = new Warung($barang);
// Menampilkan barang
$barang1->menampilkanBarang();
?>
