<?php 

// Class Mahasiswa 

class Mahasiswa { 

    private $nama; 

    private $kelas; 

    private $matkul; 

    private $nilai; 

  

    // Setter 

    public function setNama($nama) { 

        $this->nama = $nama; 

    } 

    public function setKelas($kelas) { 

        $this->kelas = $kelas; 

    } 

    public function setMatkul($matkul) { 

        $this->matkul = $matkul; 

    } 

    public function setNilai($nilai) { 

        $this->nilai = $nilai; 

    } 

  

    // Getter 

    public function getNama() { 

        return $this->nama; 

    } 

    public function getKelas() { 

        return $this->kelas; 

    } 

    public function getMatkul() { 

        return $this->matkul; 

    } 

    public function getNilai() { 

        return $this->nilai; 

    } 

  

    // Method tambahan untuk cek kelulusan 

    public function cekKelulusan() { 

        if($this->nilai >= 60) { 

            return "Lulus Kuis"; 

        } else { 

            return "Tidak Lulus Kuis"; 

        } 

    } 

} 

  

// Data Mahasiswa disimpan dalam array multidimensi 

$data = array( 

    array("Aditya", "SI 2", "Pemrograman Berorientasi Objek", 80), 

    array("Shinta", "SI 2", "Pemrograman Berorientasi Objek", 75), 

    array("Ineu",   "SI 2", "Pemrograman Berorientasi Objek", 55) 

); 

  

// Perulangan untuk membuat objek mahasiswa 

for($i = 0; $i < count($data); $i++) { 

    $mhs[$i] = new Mahasiswa(); 

    $mhs[$i]->setNama($data[$i][0]); 

    $mhs[$i]->setKelas($data[$i][1]); 

    $mhs[$i]->setMatkul($data[$i][2]); 

    $mhs[$i]->setNilai($data[$i][3]); 

} 

  

// Perulangan untuk menampilkan data 

for($i = 0; $i < count($mhs); $i++) { 

    echo "Nama : ".$mhs[$i]->getNama()."<br>"; 

    echo "Kelas : ".$mhs[$i]->getKelas()."<br>"; 

    echo "Mata Kuliah : ".$mhs[$i]->getMatkul()."<br>"; 

    echo "Nilai : ".$mhs[$i]->getNilai()."<br>"; 

    echo $mhs[$i]->cekKelulusan()."<br>"; 

    echo "<hr>"; 

} 

?> 