<?php

class Belanja {
    public $namaBarang;
    public $harga;
    public $jumlah;
    public $total;

    public function __construct($namaBarang, $harga, $jumlah) {
        $this->namaBarang = $namaBarang;
        $this->harga = $harga;
        $this->jumlah = $jumlah;
        $this->total = $this->harga * $this->jumlah;
        echo "Constructor: Data Belanja '{$this->namaBarang}' dibuat.\n";
    }

    public function getInfo() {
        return "{$this->namaBarang} ({$this->harga} x {$this->jumlah}) = {$this->total}";
    }

    public function __destruct() {
        echo "Destructor: Data Belanja '{$this->namaBarang}' dihapus.\n";
    }
}

echo "Masukkan jumlah barang yang akan dibeli: ";
$jmlBarang = (int)trim(fgets(STDIN));

$barang = [];
$totalBelanja = 0;

for ($i = 0; $i < $jmlBarang; $i++) {
    echo "--- Barang ke-" . ($i + 1) . " ---\n";
    echo "Nama barang: ";
    $nama = trim(fgets(STDIN));
    echo "Harga: ";
    $harga = (int)trim(fgets(STDIN));
    echo "Jumlah: ";
    $jumlah = (int)trim(fgets(STDIN));

    $barang[] = new Belanja($nama, $harga, $jumlah);
    $totalBelanja += $barang[$i]->total;
}

echo "\n--- Daftar Belanja ---\n";
foreach ($barang as $item) {
    echo $item->getInfo() . "\n";
}

echo "\n--- Total Keseluruhan ---\n";
echo "Total belanjaan Anda adalah: Rp" . number_format($totalBelanja, 0, ',', '.') . "\n";

?>