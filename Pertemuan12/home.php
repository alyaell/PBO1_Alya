<?php
// home.php - Halaman Utama Setelah Login Berhasil

// WAJIB: Mulai sesi untuk mengakses data user yang sudah login
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect kembali ke halaman login
    header('location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Utama - Sistem Penjualan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="kotak_login">
    <center>
        <h3>Selamat Datang, <?php echo $_SESSION['user']; ?>!</h3>
        <p>Anda telah berhasil login ke Sistem Informasi Penjualan Barang.</p>
        
        <br>
        
        <a href="tampil.php" class="tombol_login">Lihat Data Barang</a>
        
        <br><br>
        
        <a href="proses_barang.php?action=logout" class="tombol_login" style="background-color: #f44336;">Logout</a>

    </center>
</div>

</body>
</html>