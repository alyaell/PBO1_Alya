<?php

class Kendaraan
{
    // membuat class Kendaraan
    var $merek;
    var $jmlroda;
    var $harga;
    var $warna;
    var $bhnBakar;
    var $tahun;

    function setMerek($x)
    {
        $this->merek = $x;
    }

    function setHarga($x)
    {
        $this->harga = $x;
    }

    function setJmlroda($x)
    {
        $this->jmlroda = $x;
    }

    function setWarna($x)
    {
        $this->warna = $x;
    }

    function setBhnBakar($x)
    {
        $this->bhnBakar = $x;
    }

    function setTahun($x)
    {
        $this->tahun = $x;
    }
}

// Objek pertama
$kendaraan1 = new Kendaraan();
$kendaraan1->setMerek('Toyota Yaris');
$kendaraan1->setJmlroda(4);
$kendaraan1->setHarga(160000000);
$kendaraan1->setWarna('Merah');
$kendaraan1->setBhnBakar('Premium');
$kendaraan1->setTahun(2005);

// Objek kedua
$kendaraan2 = new Kendaraan();
$kendaraan2->setMerek('Honda Scoopy');
$kendaraan2->setJmlroda(2);
$kendaraan2->setHarga(13000000);
$kendaraan2->setWarna('Putih');
$kendaraan2->setBhnBakar('Premium');
$kendaraan2->setTahun(2004);

// Objek ketiga
$kendaraan3 = new Kendaraan();
$kendaraan3->setMerek('Isuzu Panther');
$kendaraan3->setJmlroda(4);
$kendaraan3->setHarga(170000000);
$kendaraan3->setWarna('Hitam');
$kendaraan3->setBhnBakar('Solar');
$kendaraan3->setTahun(2003);

// Menampilkan data objek pertama
echo $kendaraan1->merek;
echo "<br>";
echo $kendaraan1->jmlroda;
echo "<br>";
echo $kendaraan1->harga;
echo "<br>";
echo $kendaraan1->warna;
echo "<br>";
echo $kendaraan1->bhnBakar;
echo "<br>";
echo $kendaraan1->tahun;
echo "<br>";

// Menampilkan data objek kedua
echo "<br>";
echo $kendaraan2->merek;
echo "<br>";
echo $kendaraan2->jmlroda;
echo "<br>";
echo $kendaraan2->harga;
echo "<br>";
echo $kendaraan2->warna;
echo "<br>";
echo $kendaraan2->bhnBakar;
echo "<br>";
echo $kendaraan2->tahun;
echo "<br>";

// Menampilkan data objek ketiga
echo "<br>";
echo $kendaraan3->merek;
echo "<br>";
echo $kendaraan3->jmlroda;
echo "<br>";
echo $kendaraan3->harga;
echo "<br>";
echo $kendaraan3->warna;
echo "<br>";
echo $kendaraan3->bhnBakar;
echo "<br>";
echo $kendaraan3->tahun;
echo "<br>";

?>