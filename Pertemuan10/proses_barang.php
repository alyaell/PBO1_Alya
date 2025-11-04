<?php
session_start();
// --- PROTEKSI SESSION ---
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit; // Penting untuk menghentikan eksekusi kode selanjutnya
}
// Memanggil file koneksi.php (Model)
include('koneksi.php');
$koneksi = new database();
// Mengambil nilai action dari URL (GET)
$action = $_GET['action'];

// --- 1. CREATE (Add Data) ---
if($action == "add")
{
    // Memanggil fungsi tambah_data() dari Model ($koneksi)
    $koneksi->tambah_data($_POST['nama_barang'],$_POST['stok'],$_POST['harga_beli'],$_POST['harga_jual']);
    
    // Mengarahkan pengguna kembali ke halaman utama
    header('location:index.php');
}

// --- 2. UPDATE (Edit Data) ---
else if($action == "edit")
{
    // Memanggil fungsi edit_data() dari Model ($koneksi)
    $koneksi->edit_data($_POST['id_barang'],$_POST['nama_barang'],$_POST['stok'],$_POST['harga_beli'],$_POST['harga_jual']);
    
    // Mengarahkan pengguna kembali ke halaman utama
    header('location:index.php');
}

// --- 3. DELETE (Hapus Data) ---
else if($action == "delete")
{
    // Mengambil id_barang dari URL
    $id_barang = $_GET['id_barang'];
    
    // Memanggil fungsi delete_data() dari Model ($koneksi)
    $koneksi->delete_data($id_barang);
    
    // Mengarahkan pengguna kembali ke halaman utama
    header('location:index.php');
}

// --- 4. SEARCH (Cari Data) ---
else if($action == "search")
{
    // Mengambil nama barang dari form POST
    $nama_barang = $_POST['nama_barang'];
    
    // Memanggil fungsi cari_data() dari Model ($koneksi)
    $koneksi->cari_data($nama_barang);
    
    // Mengarahkan pengguna ke halaman pencarian
    header('location:cari_data.php');
}

?>