<?php

class database_supplier {

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

    // FUNGSI R (Read): Menampilkan semua data supplier
    function tampil_data(){
        $data = mysqli_query($this->koneksi,"select * from tb_supplier");
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    // FUNGSI C (Create): Menambah data supplier baru
    function tambah_data($id_supp, $nama, $alamat, $telepon, $email, $pass){
        $query = "INSERT INTO tb_supplier 
                  VALUES ('$id_supp', '$nama', '$alamat', '$telepon', '$email', '$pass')";
        mysqli_query($this->koneksi, $query);
    }
    
    // FUNGSI R (Read): Mencari data supplier (berdasarkan nama)
    function cari_data($keyword){
        $data = mysqli_query($this->koneksi,"select * from tb_supplier where nama_supplier like '%$keyword%'");
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    // FUNGSI R (Read): Mengambil data spesifik untuk proses Edit
    function tampil_edit_data($id_supplier){
        $data = mysqli_query($this->koneksi,"select * from tb_supplier where id_supplier='$id_supplier'");
        while($d = mysqli_fetch_array($data)){ 
            $hasil[] = $d;
        }
        return $hasil;
    }

    // FUNGSI U (Update): Mengubah data supplier
    function edit_data($id_supp, $nama, $alamat, $telepon, $email, $pass){
        $query = "UPDATE tb_supplier SET 
                  nama_supplier='$nama', 
                  alamat_supplier='$alamat', 
                  telepon_supplier='$telepon', 
                  email_supplier='$email', 
                  pass_supplier='$pass' 
                  WHERE id_supplier='$id_supp'";
        mysqli_query($this->koneksi, $query);
    }

    // FUNGSI D (Delete): Menghapus data supplier
    function delete_data($id_supplier){
        mysqli_query($this->koneksi,"delete from tb_supplier where id_supplier='$id_supplier'");
    }

    // FUNGSI Tambahan: Untuk Auto Generate ID Supplier (SUPP001)
    function generate_id_supplier(){
        $data = mysqli_query($this->koneksi,"SELECT MAX(id_supplier) as id_max FROM tb_supplier");
        $row = mysqli_fetch_assoc($data);
        $id_max = $row['id_max'];
        
        $id_sekarang = (int) substr($id_max, 4, 4); // Ambil 4 digit setelah SUPP
        $id_sekarang++;
        
        $id_baru = "SUPP" . sprintf("%04s", $id_sekarang);
        return $id_baru;
    }
}
?>