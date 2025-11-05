<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// Include Model Supplier
include('koneksi_supplier.php');
$db = new database_supplier();

// Ambil semua data Supplier
$data_supplier = $db->tampil_data();
?>
<!DOCTYPE html>
<html>
<head>
<title>Laporan Data Supplier</title>
<style type="text/css">
body { font-family: Arial, sans-serif; }
table { width: 90%; margin: 20px auto; border-collapse: collapse; }
th, td { border: 1px solid #000; padding: 8px; text-align: left; }
</style>
</head>
<body>

<h2 style="text-align: center;">LAPORAN DATA SUPPLIER</h2>
<table border="1">
  <tr>
    <th>No</th>
    <th>ID Supplier</th>
    <th>Nama Supplier</th>
    <th>Alamat Supplier</th>
    <th>Telepon Supplier</th>
    <th>Email Supplier</th>
  </tr>
  <?php
  $no = 1;
  foreach($data_supplier as $row){
  ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['id_supplier']; ?></td>
    <td><?php echo $row['nama_supplier']; ?></td>
    <td><?php echo $row['alamat_supplier']; ?></td>
    <td><?php echo $row['telepon_supplier']; ?></td>
    <td><?php echo $row['email_supplier']; ?></td>
  </tr>
  <?php
  }
  ?>
</table>

<script>
// Perintah untuk memunculkan dialog cetak otomatis
window.print();
</script>
</body>
</html>