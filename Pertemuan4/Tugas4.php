<?php

// Kelas untuk merepresentasikan data dan logika perhitungan volume bangun ruang
class BangunRuang {
    private $jenisBangun;
    private $sisi;
    private $jariJari;
    private $tinggi;
    private $volume;

    // Setter
    public function setJenisBangun($jenis) {
        $this->jenisBangun = $jenis;
    }
    public function setSisi($sisi) {
        $this->sisi = $sisi;
    }
    public function setJariJari($jariJari) {
        $this->jariJari = $jariJari;
    }
    public function setTinggi($tinggi) {
        $this->tinggi = $tinggi;
    }

    // Getter
    public function getJenisBangun() {
        return $this->jenisBangun;
    }
    public function getSisi() {
        return $this->sisi;
    }
    public function getJariJari() {
        return $this->jariJari;
    }
    public function getTinggi() {
        return $this->tinggi;
    }
    public function getVolume() {
        return $this->volume;
    }

    // Fungsi untuk menghitung volume berdasarkan jenis bangun
    public function hitungVolume() {
        switch ($this->jenisBangun) {
            case 'Bola':
                $this->volume = (4/3) * M_PI * pow($this->jariJari, 3);
                break;
            case 'Kerucut':
                $this->volume = (1/3) * M_PI * pow($this->jariJari, 2) * $this->tinggi;
                break;
            case 'Limas Segi Empat':
                $this->volume = pow($this->sisi, 2) * $this->tinggi / 3;
                break;
            case 'Kubus':
                $this->volume = pow($this->sisi, 3);
                break;
            case 'Tabung':
                $this->volume = M_PI * pow($this->jariJari, 2) * $this->tinggi;
                break;
            default:
                $this->volume = 0;
        }
    }

// Data dalam bentuk array
$dataBangunRuang = [
    ['jenis' => 'Bola', 'sisi' => 0, 'jariJari' => 7, 'tinggi' => 0],
    ['jenis' => 'Kerucut', 'sisi' => 0, 'jariJari' => 14, 'tinggi' => 10],
    ['jenis' => 'Limas Segi Empat', 'sisi' => 8, 'jariJari' => 0, 'tinggi' => 24],
    ['jenis' => 'Kubus', 'sisi' => 30, 'jariJari' => 0, 'tinggi' => 0],
    ['jenis' => 'Tabung', 'sisi' => 0, 'jariJari' => 7, 'tinggi' => 10],
];

echo "<h1>Tabel Volume Bangun Ruang</h1>";
echo "<table border='1' cellpadding='15' cellspacing='1'>";
echo "<thead>";
echo "<tr>";
echo "<th>Jenis Bangun Ruang</th>";
echo "<th>Sisi</th>";
echo "<th>Jari-jari</th>";
echo "<th>Tinggi</th>";
echo "<th>Volume</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Perulangan untuk memproses data dari array
foreach ($dataBangunRuang as $data) {
    // Membuat objek baru untuk setiap baris data
    $bangun = new BangunRuang();
    
    // Menggunakan setter untuk mengatur properti
    $bangun->setJenisBangun($data['jenis']);
    $bangun->setSisi($data['sisi']);
    $bangun->setJariJari($data['jariJari']);
    $bangun->setTinggi($data['tinggi']);
    
    // Memanggil fungsi untuk menghitung volume
    $bangun->hitungVolume();
    
    // Menampilkan data dalam baris tabel
    echo "<tr>";
    echo "<td>" . $bangun->getJenisBangun() . "</td>";
    echo "<td>" . $bangun->getSisi() . "</td>";
    echo "<td>" . $bangun->getJariJari() . "</td>";
    echo "<td>" . $bangun->getTinggi() . "</td>";
    echo "<td>" . $bangun->getVolume() . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

?>