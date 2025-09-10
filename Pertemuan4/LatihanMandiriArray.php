<?php 

class Kredit { 

    private $pinjaman; 
    private $bunga; 
    private $lama; 
    private $angsuran = []; 

    // Setter 
    public function setPinjaman($jumlah) { 
        $this->pinjaman = $jumlah; 
    } 

    public function setBunga($persen) { 
        $this->bunga = $persen; 
    } 

    public function setLama($bulan) { 
        $this->lama = $bulan; 
    } 

    // Getter 
    public function getPinjaman() { 
        return $this->pinjaman; 
    } 

    public function getBunga() { 
        return $this->bunga; 
    } 

    public function getLama() { 
        return $this->lama; 
    } 

    // Hitung angsuran menggunakan indexed array 
    public function hitungAngsuran() { 
        $pokok = $this->pinjaman / $this->lama; 
        $sisaBunga = ($this->pinjaman * $this->bunga) / 100; 
        $step = $sisaBunga / $this->lama; 

        for ($i = 0; $i < $this->lama; $i++) { 
            $bungaPerBulan = $sisaBunga - ($step * $i); 
            $totalAngsuran = $pokok + $bungaPerBulan; 

            // Simpan ke array dengan struktur associative 
            $this->angsuran[$i] = [ 
                'bulan' => $i + 1, 
                'pokok' => $pokok, 
                'bunga' => $bungaPerBulan, 
                'total' => $totalAngsuran 
            ]; 
        } 
    } 

    // Tampilkan hasil menggunakan foreach 
    public function tampilkanAngsuran() { 
        foreach ($this->angsuran as $data) { 
            echo "Angsuran ke-{$data['bulan']}: " . 
                 number_format($data['pokok'], 0, ',', '.') . " + " . 
                 number_format($data['bunga'], 0, ',', '.') . " = " . 
                 number_format($data['total'], 0, ',', '.') . "<br>"; 
        } 
    } 
} 

// Program utama 
$kredit = new Kredit(); 
$kredit->setPinjaman(1000000); // Rp. 1.000.000 
$kredit->setBunga(10);         // 10% 
$kredit->setLama(5);           // 5 bulan 
$kredit->hitungAngsuran(); 

echo "<h3>TOKO PEGADAIAN SYARIAH</h3>"; 
echo "Jl Keadilan No 16<br>"; 
echo "Telp 732746238<br>"; 
echo "<strong>Program Perhitungan Besaran Angsuran Hutang</strong><br><br>"; 
echo "Besaran Pinjaman: Rp." . number_format($kredit->getPinjaman(), 0, ',', '.') . "<br>"; 
echo "Masukan Besaran Bunga (%): " . $kredit->getBunga() . "<br>"; 
echo "Lama Angsuran (bulan): " . $kredit->getLama() . "<br><br>"; 

$kredit->tampilkanAngsuran(); 

?> 
