<?php

// Class induk Tabungan
class Tabungan {
    private $saldo; // saldo hanya bisa diakses dari dalam class
    protected $nama; // protected: bisa diakses oleh anak class

    public function __construct($nama, $saldoAwal) {
        $this->nama = $nama;
        $this->saldo = $saldoAwal;
    }

    // Getter saldo
    public function getSaldo() {
        return $this->saldo;
    }

    // Method setor
    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
            echo "Setor berhasil! Saldo {$this->nama} sekarang: Rp" . number_format($this->saldo, 0, ',', '.') . "\n";
        } else {
            echo "Jumlah setor tidak valid!\n";
        }
    }

    // Method tarik
    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            echo "Tarik berhasil! Saldo {$this->nama} sekarang: Rp" . number_format($this->saldo, 0, ',', '.') . "\n";
        } else {
            echo "Saldo tidak cukup atau jumlah tidak valid!\n";
        }
    }

    // Tampilkan info saldo
    public function info() {
        echo "Saldo {$this->nama}: Rp" . number_format($this->saldo, 0, ',', '.') . "\n";
    }
}

// Class anak
class Siswa1 extends Tabungan {}
class Siswa2 extends Tabungan {}
class Siswa3 extends Tabungan {}

// =========================
// Program Utama
// =========================

// Buat array siswa
$siswaList = [
    new Siswa1("Siswa 1", 100000),
    new Siswa2("Siswa 2", 150000),
    new Siswa3("Siswa 3", 200000),
];

// Tampilkan saldo awal
echo "=== Saldo Awal Tabungan Siswa ===\n";
foreach ($siswaList as $s) {
    $s->info();
}

while (true) {
    echo "\n=== Menu Tabungan Sekolah ===\n";
    echo "1. Setor\n";
    echo "2. Tarik\n";
    echo "3. Lihat Saldo\n";
    echo "4. Keluar\n";
    echo "Pilih menu: ";
    $menu = trim(fgets(STDIN));

    if ($menu == "4") {
        echo "Program selesai.\n";
        break;
    }

    echo "Pilih siswa (1/2/3): ";
    $pilih = (int)trim(fgets(STDIN));

    if ($pilih < 1 || $pilih > 3) {
        echo "Siswa tidak ada!\n";
        continue;
    }

    $siswa = $siswaList[$pilih - 1];

    switch ($menu) {
        case "1":
            echo "Masukkan jumlah setor: ";
            $jumlah = (int)trim(fgets(STDIN));
            $siswa->setor($jumlah);
            break;
        case "2":
            echo "Masukkan jumlah tarik: ";
            $jumlah = (int)trim(fgets(STDIN));
            $siswa->tarik($jumlah);
            break;
        case "3":
            $siswa->info();
            break;
        default:
            echo "Menu tidak valid!\n";
    }
}
?>
