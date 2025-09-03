<?php

class Pembayaran {
    private $punyaKartuMember;
    private $totalBelanja;
    private $diskon;
    private $totalBayar;

    public function setPunyaKartuMember($punyaKartu) {
        $this->punyaKartuMember = $punyaKartu;
    }

    public function setTotalBelanja($total) {
        $this->totalBelanja = $total;
    }

    public function hitungDiskon() {
        if ($this->punyaKartuMember) {
            // Logika untuk yang punya kartu member
            switch (true) {
                case ($this->totalBelanja > 100000):
                    $this->diskon = 15000;
                    break;
                case ($this->totalBelanja > 500000):
                    $this->diskon = 50000;
                    break;
                default:
                    $this->diskon = 0; // Kasus default jika tidak memenuhi kondisi lain
                    break;
            }
        } else {
            // Logika untuk yang tidak punya kartu member
            switch (true) {
                case ($this->totalBelanja > 100000):
                    $this->diskon = 5000;
                    break;
                default:
                    $this->diskon = 0; // Kasus default
                    break;
            }
        }
    }

    public function hitungTotalBayar() {
        $this->totalBayar = $this->totalBelanja - $this->diskon;
    }

    public function getTotalDiskon() {
        return $this->diskon;
    }

    public function getTotalBayar() {
        return $this->totalBayar;
    }
}

// Input data
$punyaKartu = true; // Ganti false jika tidak punya kartu
$totalBelanja = 334000;

// Membuat objek Pembayaran
$pembayaran = new Pembayaran();
$pembayaran->setPunyaKartuMember($punyaKartu);
$pembayaran->setTotalBelanja($totalBelanja);
$pembayaran->hitungDiskon();
$pembayaran->hitungTotalBayar();

// Menampilkan output
echo "Apakah ada kartu member: " . ($punyaKartu ? "ya" : "tidak") . "\n"; echo "<br>";
echo "Total belanjaan: " . $totalBelanja . "\n"; echo "<br>";
echo "Total Bayar: Rp " . $pembayaran->getTotalBayar() . "\n"; echo "<br>";

?>