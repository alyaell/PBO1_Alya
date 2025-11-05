<?php
session_start();
if($_SESSION['status']!="login"){ header("location:login.php?pesan=belum_login"); exit; }

include('koneksi_customer.php');
$db = new database_customer();

if(isset($_GET['cari'])){
    $keyword = $_GET['cari'];
    $data_customer = $db->cari_data($keyword); 
    $pesan_cari = "Hasil pencarian : " . $keyword;
} else {
    $data_customer = $db->tampil_data(); 
    $pesan_cari = "";
}

$koneksi = mysqli_connect("localhost","root","","belajar_oop");
?>
<!DOCTYPE html>
<html>
<head><title>Data Customer</title></head>
<body>

<p>
    <a href="index.php">Beranda</a> | <a href="index.php">Data Barang</a> | <b><a href="tampil_customer.php">Data Customer</a></b> | <a href="tampil_supplier.php">Data Supplier</a> | <a href="logout.php">Logout</a>
</p>
<hr/>

<form method="get">
    <input type="text" name="cari" placeholder="Cari Nama Customer">
    <input type="submit" value="Cari">
</form>

<a href="tambah_customer.php"><button>Tambah Data Customer</button></a>&nbsp;&nbsp;
<a href="cetak_customer.php" target="_BLANK"><button>Print Data Customer</button></a>

<?php if (!empty($pesan_cari)) { echo "<p>".$pesan_cari."</p>"; } ?>

<table border="1">
    <tr>
        <th>ID Customer</th><th>NIK Customer</th><th>Nama Customer</th><th>Jenis Kelamin</th>
        <th>Alamat Customer</th><th>Telepon Customer</th><th>Email Customer</th><th>Action</th>
    </tr>
    <?php if(!empty($data_customer)){ foreach($data_customer as $row){ ?>
        <tr>
            <td><?php echo $row['id_customer']; ?></td><td><?php echo $row['nik_customer']; ?></td><td><?php echo $row['nama_customer']; ?></td>
            <td><?php echo $row['jenis_kelamin']; ?></td><td><?php echo $row['alamat_customer']; ?></td><td><?php echo $row['telepon_customer']; ?></td>
            <td><?php echo $row['email_customer']; ?></td>
            <td>
                <a href="edit_customer.php?id_customer=<?php echo $row['id_customer']; ?>&action=edit">Edit</a>
                <a href="proses_customer.php?id_customer=<?php echo $row['id_customer']; ?>&action=delete">Hapus</a>
            </td>
        </tr>
    <?php } } else { echo "<tr><td colspan='8'>Data Customer tidak ditemukan.</td></tr>"; } ?>
</table>

<form method="get" action="cetak_satuan_customer.php" target="_blank" style="margin-top:20px;">
    <input type="text" name="id_customer" placeholder="Masukkan ID Customer">
    <input type="submit" value="Print Satuan Customer">
</form>

<br/>
<a href="logout.php"><button>Keluar Aplikasi</button></a>

</body>
</html>