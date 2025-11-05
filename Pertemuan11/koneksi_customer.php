<?php

class database_customer {

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

    // FUNGSI R (Read): Menampilkan semua data customer
    function tampil_data(){
        $data = mysqli_query($this->koneksi,"select * from tb_customer");
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    // FUNGSI C (Create): Menambah data customer baru
    function tambah_data($id_cust, $nik, $nama, $jk, $alamat, $telepon, $email, $pass){
        $query = "INSERT INTO tb_customer 
                  VALUES ('$id_cust', '$nik', '$nama', '$jk', '$alamat', '$telepon', '$email', '$pass')";
        mysqli_query($this->koneksi, $query);
    }
    
    // FUNGSI R (Read): Mencari data customer
    function cari_data($keyword){
        $data = mysqli_query($this->koneksi,"select * from tb_customer where nama_customer like '%$keyword%' OR nik_customer like '%$keyword%'");
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    // FUNGSI R (Read): Mengambil data spesifik untuk proses Edit
    function tampil_edit_data($id_customer){
        $data = mysqli_query($this->koneksi,"select * from tb_customer where id_customer='$id_customer'");
        while($d = mysqli_fetch_array($data)){ 
            $hasil[] = $d;
        }
        return $hasil;
    }

    // FUNGSI U (Update): Mengubah data customer
    function edit_data($id_cust, $nik, $nama, $jk, $alamat, $telepon, $email, $pass){
        $query = "UPDATE tb_customer SET 
                  nik_customer='$nik', 
                  nama_customer='$nama', 
                  jenis_kelamin='$jk', 
                  alamat_customer='$alamat', 
                  telepon_customer='$telepon', 
                  email_customer='$email', 
                  pass_customer='$pass' 
                  WHERE id_customer='$id_cust'";
        mysqli_query($this->koneksi, $query);
    }

    // FUNGSI D (Delete): Menghapus data customer
    function delete_data($id_customer){
        mysqli_query($this->koneksi,"delete from tb_customer where id_customer='$id_customer'");
    }

    // FUNGSI Tambahan: Untuk Auto Generate ID Customer (CST001)
    function generate_id_customer(){
        // Mencari ID terakhir
        $data = mysqli_query($this->koneksi,"SELECT MAX(id_customer) as id_max FROM tb_customer");
        $row = mysqli_fetch_assoc($data);
        $id_max = $row['id_max'];
        
        // Mengambil angka terakhir
        $id_sekarang = (int) substr($id_max, 3, 4);
        $id_sekarang++;
        
        // Menggabungkan prefix 'CST' dengan nomor baru yang diformat
        $id_baru = "CST" . sprintf("%04s", $id_sekarang);
        return $id_baru;
    }
}
?>