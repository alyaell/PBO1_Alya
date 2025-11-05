<?php
// 1. Amankan Sesi
session_start();
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// 2. Include Model Supplier
include('koneksi_supplier.php');
$koneksi = new database_supplier();

$action = $_GET['action'];

// --- FUNGSI CREATE (Tambah Data) ---
if($action == "add")
{
    // Ambil data dari form Tambah Data Supplier
    $id_supplier = $_POST['id_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $telepon_supplier = $_POST['telepon_supplier'];
    $email_supplier = $_POST['email_supplier'];
    $pass_supplier = $_POST['pass_supplier'];

    // Panggil method tambah_data
    $koneksi->tambah_data(
        $id_supplier,
        $nama_supplier,
        $alamat_supplier,
        $telepon_supplier,
        $email_supplier,
        $pass_supplier
    );
    
    // Redirect kembali ke halaman tampil supplier
    header('location:tampil_supplier.php'); 
}

// --- FUNGSI UPDATE (Edit Data) ---
else if($action == "edit")
{
    // Ambil semua data termasuk ID
    $id_supplier = $_POST['id_supplier']; 
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $telepon_supplier = $_POST['telepon_supplier'];
    $email_supplier = $_POST['email_supplier'];
    $pass_supplier = $_POST['pass_supplier'];
    
    // Panggil method edit_data
    $koneksi->edit_data(
        $id_supplier,
        $nama_supplier,
        $alamat_supplier,
        $telepon_supplier,
        $email_supplier,
        $pass_supplier
    );

    // Redirect kembali ke halaman tampil supplier
    header('location:tampil_supplier.php');
}

// --- FUNGSI DELETE (Hapus Data) ---
else if($action == "delete")
{
    $id_supplier = $_GET['id_supplier']; // Ambil ID dari URL
    $koneksi->delete_data($id_supplier);
    
    // Redirect kembali ke halaman tampil supplier
    header('location:tampil_supplier.php');
}
?>