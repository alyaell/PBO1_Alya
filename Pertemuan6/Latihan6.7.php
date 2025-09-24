<?php

class Karyawan {
    private $nama;
    private $golongan;
    private $jamLembur;
    private $gajiPokok;
    private $totalGaji;

    public function __construct($nama, $golongan, $jamLembur) {
        $this->nama = $nama;
        $this->golongan = $golongan;
        $this->jamLembur = $jamLembur;
        $this->gajiPokok = $this->getGajiPokok($golongan);
        $this->totalGaji = $this->gajiPokok + ($jamLembur * 15000);

        echo "Constructor: Data karyawan {$this->nama} dibuat.\n";
    }

    // Setter & Getter
    public function getNama() { return $this->nama; }
    public function getGolongan() { return $this->golongan; }
    public function getJamLembur() { return $this->jamLembur; }
    public function getTotalGaji() { return $this->totalGaji; }

    // Method gaji pokok
    private function getGajiPokok($golongan) {
        $gaji = [
            "Ib" => 1250000, "Ic" => 1300000, "Id" => 1350000,
            "IIa" => 2000000, "IIb" => 2100000, "IIc" => 2200000, "IId" => 2300000,
            "IIIa" => 2400000, "IIIb" => 2500000, "IIIc" => 2600000, "IIId" => 2700000,
            "IVa" => 2800000, "IVb" => 2900000, "IVc" => 3000000, "IVd" => 3100000
        ];
        return $gaji[$golongan] ?? 0;
    }

    public function getInfo() {
        return sprintf(
            "%-12s %-8s %-12d Rp%s",
            $this->nama,
            $this->golongan,
            $this->jamLembur,
            number_format($this->totalGaji, 0, ',', '.')
        );
    }

    public function __destruct() {
        echo "Destructor: Data karyawan {$this->nama} dihapus.\n";
    }
}

// Input jumlah karyawan
echo "Masukkan jumlah karyawan: ";
$jmlKaryawan = (int)trim(fgets(STDIN));

$karyawanList = [];

// Input data karyawan
for ($i = 0; $i < $jmlKaryawan; $i++) {
    echo "\n--- Data Karyawan ke-" . ($i + 1) . " ---\n";
    echo "Nama Karyawan: ";
    $nama = trim(fgets(STDIN));
    echo "Golongan: ";
    $gol = trim(fgets(STDIN));
    echo "Total Jam Lembur: ";
    $jam = (int)trim(fgets(STDIN));

    $karyawanList[] = new Karyawan($nama, $gol, $jam);
}

// Tampilkan tabel
echo "\n--- Daftar Gaji Karyawan ---\n";
printf("%-12s %-8s %-12s %s\n", "Nama", "Gol", "Jam Lembur", "Total Gaji");

foreach ($karyawanList as $k) {
    echo $k->getInfo() . "\n";
}

// Hapus objek (trigger destructor)
foreach ($karyawanList as $k) {
    unset($k);
}

?>
