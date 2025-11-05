<?php
session_start();
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi_customer.php');
$db = new database_customer();

$data_customer = $db->tampil_data();
?>
<!DOCTYPE html>
<html>
<head>
<title>Laporan Data Customer</title>
<style type="text/css">
body { font-family: Arial, sans-serif; }
table { width: 95%; margin: 20px auto; border-collapse: collapse; font-size: 10pt; }
th, td { border: 1px solid #000; padding: 5px; text-align: left; }
</style>
</head>
<body>

<h2 style="text-align: center;">LAPORAN DATA CUSTOMER</h2>
<table border="1">
    <tr>
        <th>No</th>
        <th>ID Customer</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Email</th>
    </tr>
    <?php
    $no = 1;
    foreach($data_customer as $row){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row['id_customer']; ?></td>
        <td><?php echo $row['nik_customer']; ?></td>
        <td><?php echo $row['nama_customer']; ?></td>
        <td><?php echo $row['jenis_kelamin']; ?></td>
        <td><?php echo $row['alamat_customer']; ?></td>
        <td><?php echo $row['telepon_customer']; ?></td>
        <td><?php echo $row['email_customer']; ?></td>
    </tr>
    <?php
    }
    ?>
</table>

<script>
window.print();
</script>
</body>
</html>