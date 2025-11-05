<?php
// 1. Amankan Sesi
session_start();
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// 2. Include Model Customer
include('koneksi_customer.php');
$koneksi = new database_customer();

$action = $_GET['action'];

// --- FUNGSI CREATE (Tambah Data) ---
if($action == "add")
{
    // Ambil data dari form Tambah Data Customer
    $id_customer = $_POST['id_customer'];
    $nik_customer = $_POST['nik_customer'];
    $nama_customer = $_POST['nama_customer'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat_customer = $_POST['alamat_customer'];
    $telepon_customer = $_POST['telepon_customer'];
    $email_customer = $_POST['email_customer'];
    $pass_customer = $_POST['pass_customer'];

    // Panggil method tambah_data di class database_customer
    $koneksi->tambah_data(
        $id_customer,
        $nik_customer,
        $nama_customer,
        $jenis_kelamin,
        $alamat_customer,
        $telepon_customer,
        $email_customer,
        $pass_customer
    );
    
    // Redirect kembali ke halaman tampil data customer
    header('location:tampil_customer.php');
}

// --- FUNGSI UPDATE (Edit Data) ---
else if($action == "edit")
{
    // Ambil semua data termasuk ID untuk klausa WHERE
    $id_customer = $_POST['id_customer']; // Hidden input dari edit_customer.php
    $nik_customer = $_POST['nik_customer'];
    $nama_customer = $_POST['nama_customer'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat_customer = $_POST['alamat_customer'];
    $telepon_customer = $_POST['telepon_customer'];
    $email_customer = $_POST['email_customer'];
    $pass_customer = $_POST['pass_customer'];
    
    // Panggil method edit_data di class database_customer
    $koneksi->edit_data(
        $id_customer,
        $nik_customer,
        $nama_customer,
        $jenis_kelamin,
        $alamat_customer,
        $telepon_customer,
        $email_customer,
        $pass_customer
    );

    // Redirect kembali ke halaman tampil data customer
    header('location:tampil_customer.php');
}

// --- FUNGSI DELETE (Hapus Data) ---
else if($action == "delete")
{
    $id_customer = $_GET['id_customer']; // Ambil ID dari URL
    $koneksi->delete_data($id_customer);
    
    // Redirect kembali ke halaman tampil data customer
    header('location:tampil_customer.php');
}
?>