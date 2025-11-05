<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi_supplier.php');
$db = new database_supplier();

// Ambil ID Supplier dari URL
$id_supplier = $_GET['id_supplier'];

// Panggil fungsi tampil_edit_data untuk mendapatkan detail satuan
$data_supplier = $db->tampil_edit_data($id_supplier); 
$row = mysqli_fetch_array(mysqli_query($db->koneksi, "SELECT * FROM tb_supplier WHERE id_supplier='$id_supplier'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 400px; margin: 20px auto; border-collapse: collapse; }
        td { padding: 8px; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">LAPORAN DETAIL SUPPLIER</h2>
    <hr>
    
    <table>
        <tr><td>ID Supplier</td><td>: <?php echo $row['id_supplier']; ?></td></tr>
        <tr><td>Nama Supplier</td><td>: <?php echo $row['nama_supplier']; ?></td></tr>
        <tr><td>Alamat Supplier</td><td>: <?php echo $row['alamat_supplier']; ?></td></tr>
        <tr><td>Telepon</td><td>: <?php echo $row['telepon_supplier']; ?></td></tr>
        <tr><td>Email</td><td>: <?php echo $row['email_supplier']; ?></td></tr>
        <tr><td>Password</td><td>: *********</td></tr>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>