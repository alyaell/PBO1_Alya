<?php
// ==========================
// Class Induk: Employee
// ==========================
class Employee {
    public $nama;
    public $gaji;
    public $lamaKerja;

    public function __construct($nama, $gaji, $lamaKerja) {
        $this->nama = $nama;
        $this->gaji = $gaji;
        $this->lamaKerja = $lamaKerja;
    }

    // Method dasar (bisa dioverride)
    public function hitungGaji() {
        return $this->gaji;
    }

    public function info() {
        echo "Nama: $this->nama, Gaji: Rp " . $this->hitungGaji() . "<br>";
    }
}

// ==========================
// 1. Programmer (Inheritance + Overriding)
// ==========================
class Programmer extends Employee {
    public function hitungGaji() {
        $bonus = 0;
        if ($this->lamaKerja >= 1 && $this->lamaKerja <= 10) {
            $bonus = 0.01 * $this->lamaKerja * $this->gaji;
        } elseif ($this->lamaKerja > 10) {
            $bonus = 0.02 * $this->lamaKerja * $this->gaji;
        }
        return $this->gaji + $bonus;
    }
}

// ==========================
// 2. Direktur (Inheritance + Overriding)
// ==========================
class Direktur extends Employee {
    public function hitungGaji() {
        $bonus = 0.5 * $this->lamaKerja * $this->gaji;
        $tunjangan = 0.1 * $this->lamaKerja * $this->gaji;
        return $this->gaji + $bonus + $tunjangan;
    }
}

// ==========================
// 3. Pegawai Mingguan (Inheritance + Overriding)
// ==========================
class PegawaiMingguan extends Employee {
    public $hargaBarang;
    public $stockBarang;
    public $penjualan;

    public function __construct($nama, $gaji, $lamaKerja, $hargaBarang, $stockBarang, $penjualan) {
        parent::__construct($nama, $gaji, $lamaKerja);
        $this->hargaBarang = $hargaBarang;
        $this->stockBarang = $stockBarang;
        $this->penjualan = $penjualan;
    }

    public function hitungGaji() {
        $bonus = 0;
        if ($this->penjualan > (0.7 * $this->stockBarang)) {
            $bonus = 0.1 * $this->hargaBarang * $this->penjualan;
        } else {
            $bonus = 0.03 * $this->hargaBarang * $this->penjualan;
        }
        return $this->gaji + $bonus;
    }
}

// ov
class HitungBonus {
    public function __call($method, $args) {
        if ($method == "bonus") {
            if (count($args) == 1) {
                return $args[0]; // cuma return nilai
            } elseif (count($args) == 2) {
                return $args[0] * $args[1]; // harga × jumlah
            } else {
                return 0;
            }
        }
    }
}

// ==========================
// Contoh penggunaan
// ==========================
$programmer = new Programmer("Alya", 5000000, 8);
$direktur = new Direktur("Andi", 10000000, 12);
$pegawaiMingguan = new PegawaiMingguan("Budi", 3000000, 5, 20000, 100, 80);

echo "--- Programmer ---<br>";
$programmer->info();

echo "--- Direktur ---<br>";
$direktur->info();

echo "--- Pegawai Mingguan ---<br>";
$pegawaiMingguan->info();

echo "--- Overloading ---<br>";
$bonus = new HitungBonus();
echo "Bonus 1 param: " . $bonus->bonus(10000) . "<br>";
echo "Bonus 2 param: " . $bonus->bonus(2000, 5) . "<br>";
?>
