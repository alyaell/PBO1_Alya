<?php

class database {

    // Konfigurasi Koneksi
    var $host = "localhost";
    var $username = "root";
    var $password = ""; 
    var $database = "belajar_oop";
    var $koneksi = "";

    // Constructor untuk inisiasi koneksi
    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if(mysqli_connect_error()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    // Fungsi READ (R): Menampilkan semua data
    function tampil_data(){
        $data = mysqli_query($this->koneksi,"select * from tb_barang");
        // Menggunakan $row, sesuai baris 19-21
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Fungsi CREATE (C): Menambah data
    function tambah_data($nama_barang, $stok, $harga_beli, $harga_jual){
        mysqli_query($this->koneksi,"insert into tb_barang values('', '$nama_barang', '$stok', '$harga_beli', '$harga_jual')");
    }

    // Fungsi READ (R): Mengambil data spesifik untuk proses edit
    function tampil_edit_data($id_barang){
        $data = mysqli_query($this->koneksi,"select * from tb_barang where id_barang='$id_barang'");
        // Menggunakan $d, sesuai baris 35-37
        while($d = mysqli_fetch_array($data)){ 
            $hasil[] = $d;
        }
        return $hasil;
    }

    // Fungsi UPDATE (U): Mengubah data
    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        mysqli_query($this->koneksi,"update tb_barang set nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' where id_barang='$id_barang'");
    }

    // Fungsi DELETE (D): Menghapus data
    function delete_data($id_barang){
        mysqli_query($this->koneksi,"delete from tb_barang where id_barang='$id_barang'");
    }

    // Fungsi READ (R): Mencari data berdasarkan nama barang
    function cari_data($nama_barang){
        $data = mysqli_query($this->koneksi,"select * from tb_barang where nama_barang like '%$nama_barang%'");
        // Menggunakan $row, sesuai baris 53-55
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }
}

?>