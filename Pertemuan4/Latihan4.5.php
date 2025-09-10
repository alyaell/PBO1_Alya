<?php 

class Kendaraan { 

    private $merek; 
    private $jmlRoda; 
    private $harga; 
    private $warna; 
    private $bhnBakar; 
    private $tahun; 

    // Setter 
    public function setMerek($merek) { 
        $this->merek = $merek; 
    } 

    public function setJmlRoda($jmlRoda) { 
        $this->jmlRoda = $jmlRoda; 
    } 

    public function setHarga($harga) { 
        $this->harga = $harga; 
    } 

    public function setWarna($warna) { 
        $this->warna = $warna; 
    } 

    public function setBhnBakar($bhnBakar) { 
        $this->bhnBakar = $bhnBakar; 
    } 

    public function setTahun($tahun) { 
        $this->tahun = $tahun; 
    } 

    // Getter 
    public function getMerek() { 
        return $this->merek; 
    } 

    public function getJmlRoda() { 
        return $this->jmlRoda; 
    } 

    public function getHarga() { 
        return "Rp. " . number_format($this->harga, 0, ',', '.'); 
    } 

    public function getWarna() { 
        return $this->warna; 
    } 

    public function getBhnBakar() { 
        return $this->bhnBakar; 
    } 

    public function getTahun() { 
        return $this->tahun; 
    } 

    // Tambahan logika 
    public function statusHarga() { 
        return $this->harga > 50000000 ? "Harga Mahal" : "Harga Terjangkau"; 
    } 

    public function dapatSubsidi() { 
        return ($this->bhnBakar == "Solar" || $this->bhnBakar == "Premium") ? "Dapat Subsidi" : "Tidak Dapat Subsidi"; 
    } 

    public function hargaSecondKendaraan() { 
        $tahunSekarang = date("Y"); 
        $umur = $tahunSekarang - $this->tahun; 
        $penurunan = $umur * 0.05 * $this->harga; 
        $hargaSecond = $this->harga - $penurunan; 
        return "Harga Second: Rp. " . number_format($hargaSecond, 0, ',', '.'); 
    } 
} 

// Data kendaraan 
$Data1 = array('Toyota Yaris','4','160000000','Merah','Pertamax','2014'); 
$Data2 = array('Honda Scoopy','2','13000000','Putih','Premium','2005'); 
$Data3 = array('Isuzu Panther','4','40000000','Hitam','Solar','1994'); 

$dataArray = [$Data1, $Data2, $Data3]; 

// Proses dan tampilkan 
for ($i = 0; $i < count($dataArray); $i++) { 
    $kendaraan[$i] = new Kendaraan(); 
    $kendaraan[$i]->setMerek($dataArray[$i][0]); 
    $kendaraan[$i]->setJmlRoda($dataArray[$i][1]); 
    $kendaraan[$i]->setHarga($dataArray[$i][2]); 
    $kendaraan[$i]->setWarna($dataArray[$i][3]); 
    $kendaraan[$i]->setBhnBakar($dataArray[$i][4]); 
    $kendaraan[$i]->setTahun($dataArray[$i][5]); 

    echo "Kendaraan " . ($i + 1) . "<br>"; 
    echo $kendaraan[$i]->getMerek() . "<br>"; 
    echo $kendaraan[$i]->getJmlRoda() . " roda<br>"; 
    echo $kendaraan[$i]->getHarga() . "<br>"; 
    echo $kendaraan[$i]->getWarna() . "<br>"; 
    echo $kendaraan[$i]->getBhnBakar() . "<br>"; 
    echo $kendaraan[$i]->getTahun() . "<br>"; 
    echo $kendaraan[$i]->statusHarga() . "<br>"; 
    echo $kendaraan[$i]->dapatSubsidi() . "<br>"; 
    echo $kendaraan[$i]->hargaSecondKendaraan() . "<br><br>"; 
} 

?>
