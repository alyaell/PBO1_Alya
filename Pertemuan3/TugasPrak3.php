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
            if ($this->totalBelanja > 500000) {
                $this->diskon = 50000;
            } elseif ($this->totalBelanja > 100000) {
                $this->diskon = 15000;
            } else {
                $this->diskon = 0;
            }
        } else {
            if ($this->totalBelanja > 100000) {
                $this->diskon = 5000;
            } else {
                $this->diskon = 0;
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
    
    public function getPunyaKartuMember() {
        return $this->punyaKartuMember;
    }
    
    public function getTotalBelanja() {
        return $this->totalBelanja;
    }
}

// Membuat objek Pembayaran untuk setiap pembeli secara terpisah
$pembeli1 = new Pembayaran();
$pembeli2 = new Pembayaran();
$pembeli3 = new Pembayaran();
$pembeli4 = new Pembayaran();

// --- PEMBELI 1 ---
echo "===== Pembeli 1 =====<br>";
$pembeli1->setPunyaKartuMember(true);
$pembeli1->setTotalBelanja(200000);
$pembeli1->hitungDiskon();
$pembeli1->hitungTotalBayar();
echo "Apakah ada kartu member: " . ($pembeli1->getPunyaKartuMember() ? "ya" : "tidak") . "<br>";
echo "Total belanjaan: Rp " . number_format($pembeli1->getTotalBelanja(), 0, ',', '.') . "<br>";
echo "Diskon: Rp " . number_format($pembeli1->getTotalDiskon(), 0, ',', '.') . "<br>";
echo "Biaya yang dikeluarkan: Rp " . number_format($pembeli1->getTotalBayar(), 0, ',', '.') . "<br><br>";

// --- PEMBELI 2 ---
echo "===== Pembeli 2 =====<br>";
$pembeli2->setPunyaKartuMember(true);
$pembeli2->setTotalBelanja(570000);
$pembeli2->hitungDiskon();
$pembeli2->hitungTotalBayar();
echo "Apakah ada kartu member: " . ($pembeli2->getPunyaKartuMember() ? "ya" : "tidak") . "<br>";
echo "Total belanjaan: Rp " . number_format($pembeli2->getTotalBelanja(), 0, ',', '.') . "<br>";
echo "Diskon: Rp " . number_format($pembeli2->getTotalDiskon(), 0, ',', '.') . "<br>";
echo "Biaya yang dikeluarkan: Rp " . number_format($pembeli2->getTotalBayar(), 0, ',', '.') . "<br><br>";

// --- PEMBELI 3 ---
echo "===== Pembeli 3 =====<br>";
$pembeli3->setPunyaKartuMember(false);
$pembeli3->setTotalBelanja(120000);
$pembeli3->hitungDiskon();
$pembeli3->hitungTotalBayar();
echo "Apakah ada kartu member: " . ($pembeli3->getPunyaKartuMember() ? "ya" : "tidak") . "<br>";
echo "Total belanjaan: Rp " . number_format($pembeli3->getTotalBelanja(), 0, ',', '.') . "<br>";
echo "Diskon: Rp " . number_format($pembeli3->getTotalDiskon(), 0, ',', '.') . "<br>";
echo "Biaya yang dikeluarkan: Rp " . number_format($pembeli3->getTotalBayar(), 0, ',', '.') . "<br><br>";

// --- PEMBELI 4 ---
echo "===== Pembeli 4 =====<br>";
$pembeli4->setPunyaKartuMember(false);
$pembeli4->setTotalBelanja(90000);
$pembeli4->hitungDiskon();
$pembeli4->hitungTotalBayar();
echo "Apakah ada kartu member: " . ($pembeli4->getPunyaKartuMember() ? "ya" : "tidak") . "<br>";
echo "Total belanjaan: Rp " . number_format($pembeli4->getTotalBelanja(), 0, ',', '.') . "<br>";
echo "Diskon: Rp " . number_format($pembeli4->getTotalDiskon(), 0, ',', '.') . "<br>";
echo "Biaya yang dikeluarkan: Rp " . number_format($pembeli4->getTotalBayar(), 0, ',', '.') . "<br><br>";

?>