<?php
session_start();
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi_customer.php');
$db = new database_customer();

// Ambil ID Customer dari URL
$id_customer = $_GET['id_customer'];

// Query untuk mengambil detail data
$query = mysqli_query($db->koneksi, "SELECT * FROM tb_customer WHERE id_customer='$id_customer'");
$row = mysqli_fetch_array($query);

// Cek apakah data ditemukan
if (empty($row)) {
    echo "Data Customer dengan ID: $id_customer tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Customer</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 450px; margin: 20px auto; border-collapse: collapse; }
        td { padding: 8px; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">LAPORAN DETAIL CUSTOMER</h2>
    <hr>
    
    <table>
        <tr><td>ID Customer</td><td>: <?php echo $row['id_customer']; ?></td></tr>
        <tr><td>NIK Customer</td><td>: <?php echo $row['nik_customer']; ?></td></tr>
        <tr><td>Nama Customer</td><td>: <?php echo $row['nama_customer']; ?></td></tr>
        <tr><td>Jenis Kelamin</td><td>: <?php echo $row['jenis_kelamin']; ?></td></tr>
        <tr><td>Alamat</td><td>: <?php echo $row['alamat_customer']; ?></td></tr>
        <tr><td>Telepon</td><td>: <?php echo $row['telepon_customer']; ?></td></tr>
        <tr><td>Email</td><td>: <?php echo $row['email_customer']; ?></td></tr>
        <tr><td>Password</td><td>: *********</td></tr>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>