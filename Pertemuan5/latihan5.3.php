<?php
// Parent class
class BangunDatar {
    public function luas() {
        return 0;
    }

    public function keliling() {
        return 0;
    }
}

// Child class Persegi
class Persegi extends BangunDatar {
    public $sisi;

    public function __construct($sisi) {
        $this->sisi = $sisi;
    }

    public function luas() {
        return $this->sisi * $this->sisi;
    }

    public function keliling() {
        return 4 * $this->sisi;
    }
}

// Child class Lingkaran
class Lingkaran extends BangunDatar {
    public $r;

    public function __construct($r) {
        $this->r = $r;
    }

    public function luas() {
        return 3.14 * $this->r * $this->r;
    }

    public function keliling() {
        return 2 * 3.14 * $this->r;
    }
}

// Child class Persegi Panjang
class PersegiPanjang extends BangunDatar {
    public $panjang;
    public $lebar;

    public function __construct($panjang, $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    public function luas() {
        return $this->panjang * $this->lebar;
    }

    public function keliling() {
        return 2 * ($this->panjang + $this->lebar);
    }
}

// Child class Segitiga
class Segitiga extends BangunDatar {
    public $alas;
    public $tinggi;

    public function __construct($alas, $tinggi) {
        $this->alas = $alas;
        $this->tinggi = $tinggi;
    }

    public function luas() {
        return 0.5 * $this->alas * $this->tinggi;
    }

    public function keliling() {
        // Anggap segitiga sama sisi untuk contoh sederhana
        return 3 * $this->alas;
    }
}

// Main
echo "=== PERSEGI ===<br>";
$persegi = new Persegi(5);
echo "Luas: " . $persegi->luas() . "<br>";
echo "Keliling: " . $persegi->keliling() . "<br><br>";

echo "=== LINGKARAN ===<br>";
$lingkaran = new Lingkaran(7);
echo "Luas: " . $lingkaran->luas() . "<br>";
echo "Keliling: " . $lingkaran->keliling() . "<br><br>";

echo "=== PERSEGI PANJANG ===<br>";
$pp = new PersegiPanjang(10, 4);
echo "Luas: " . $pp->luas() . "<br>";
echo "Keliling: " . $pp->keliling() . "<br><br>";

echo "=== SEGITIGA ===<br>";
$segitiga = new Segitiga(6, 8);
echo "Luas: " . $segitiga->luas() . "<br>";
echo "Keliling: " . $segitiga->keliling() . "<br>";
?>
