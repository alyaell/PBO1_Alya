<?php
// Memulai session
session_start();

// Hancurkan semua session
session_destroy();

// Arahkan kembali ke halaman login
header("location:login.php?pesan=logout");
?>