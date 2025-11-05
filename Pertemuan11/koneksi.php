<?php

class database {

    var $host = "localhost";
    var $username = "root";
    var $password = ""; 
    var $database = "belajar_oop";
    var $koneksi = "";

    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if(mysqli_connect_error()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function tampil_data(){
        $data = mysqli_query($this->koneksi,"select * from tb_barang");
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        mysqli_query($this->koneksi,"insert into tb_barang values ('','$id_barang','$nama_barang','$stok','$harga_beli','$harga_jual')");
    }

    function tampil_edit_data($id_barang){
        $data = mysqli_query($this->koneksi,"select * from tb_barang where id_barang='$id_barang'");
        while($d = mysqli_fetch_array($data)){ 
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        mysqli_query($this->koneksi,"update tb_barang set nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' where id_barang='$id_barang'");
    }

    function delete_data($id_barang){
        mysqli_query($this->koneksi,"delete from tb_barang where id_barang='$id_barang'");
    }
    
    function kode_barang(){
        $data = mysqli_query($this->koneksi,"SELECT MAX(kd_barang) as kd_barang FROM tb_barang");
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }

        // Tambahkan di dalam class database
    function cari_data($keyword){
        // Menggunakan operator LIKE dengan wildcard (%) untuk mencari nama barang yang mengandung kata kunci
        $data = mysqli_query($this->koneksi,"select * from tb_barang where nama_barang like '%$keyword%'");
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Tambahkan fungsi untuk mengambil data per satuan (berdasarkan Kode Barang)
    function tampil_data_satuan($kd_barang){
        $data = mysqli_query($this->koneksi,"select * from tb_barang where kd_barang='$kd_barang'");
        return $data; // Mengembalikan hasil query untuk diproses
    }
}

?>