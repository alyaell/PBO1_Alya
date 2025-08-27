<?php
class Kendaraan
{
    // Variabel (properti/atribut class)
    public $JumlahRoda = 4;
    public $warna;
    public $bahanBakar = "Premium";
    public $harga = 100000000;
    public $merek;
    public $tahunPembuatan = 2004;

    // Method untuk cek status harga
    public function statusHarga()
    {
        if ($this->harga > 50000000) {
            $status = "Harga Kendaraan Mahal";
        } else {
            $status = "Harga Kendaraan Murah";
        }
        return $status;
    }

    // Method untuk cek subsidi
    public function dapatSubsidi()
    {
        if ($this->tahunPembuatan < 2005 && $this->bahanBakar == "Premium") {
            $status = "DAPAT SUBSIDI";
        } else {
            $status = "TIDAK DAPAT SUBSIDI";
        }
        return $status;
    }

    // Method tambahan untuk contoh (harga second)
    public function hargaSecondKendaraan()
    {
        if ($this->tahunPembuatan < 2000) {
            $harga = $this->harga * 0.4;
        } else {
            $harga = $this->harga * 0.6;
        }
        return $harga;
    }
}

// -----------------------------------------------------
// Objek 1
$ObjekKendaraan1 = new Kendaraan();
$ObjekKendaraan1->harga = 100000000;
$ObjekKendaraan1->tahunPembuatan = 1999;

echo "Status Harga: " . $ObjekKendaraan1->statusHarga();
echo "<br>";

// Objek 2
$ObjekKendaraan2 = new Kendaraan();
$ObjekKendaraan2->bahanBakar = "Pertamax";
$ObjekKendaraan2->tahunPembuatan = 1999;

echo "Status BBM: " . $ObjekKendaraan2->dapatSubsidi();
echo "<br>";
echo "Harga Bekas: " . $ObjekKendaraan2->hargaSecondKendaraan();
?>
