<?php
include('koneksi.php');
$db = new database();

$kd_barang = $_GET['kd_barang'];

// Panggil fungsi tampil_data_satuan
$data_barang_satuan = $db->tampil_data_satuan($kd_barang);
$row = mysqli_fetch_array($data_barang_satuan);

// Hitung keuntungan
$keuntungan = $row['harga_jual'] - $row['harga_beli'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Barang: <?php echo $row['nama_barang']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 400px; margin: 20px auto; border-collapse: collapse; }
        td { padding: 8px; border: 1px solid #ccc; }
    </style>
</head>
<body>

    <h2>Laporan Detail Barang: <?php echo $row['nama_barang']; ?></h2>
    <hr>
    
    <table>
        <tr><td>Kode Barang</td><td>: <?php echo $row['kd_barang']; ?></td></tr>
        <tr><td>Nama Barang</td><td>: <?php echo $row['nama_barang']; ?></td></tr>
        <tr><td>Stok</td><td>: <?php echo $row['stok']; ?></td></tr>
        <tr><td>Harga Beli</td><td>: <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td></tr>
        <tr><td>Harga Jual</td><td>: <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td></tr>
        <tr><td>**Keuntungan**</td><td>: **<?php echo number_format($keuntungan, 0, ',', '.'); ?>**</td></tr>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>