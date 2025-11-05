<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi_supplier.php');
$db = new database_supplier();

// Logic Pencarian Supplier
if(isset($_GET['cari'])){
    $keyword = $_GET['cari'];
    $data_supplier = $db->cari_data($keyword); 
    $pesan_cari = "Hasil pencarian : " . $keyword;
} else {
    $data_supplier = $db->tampil_data(); 
    $pesan_cari = "";
}

$koneksi = mysqli_connect("localhost","root","","belajar_oop");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Supplier</title>
</head>
<body>

<p>
    <a href="index.php">Beranda</a> |
    <a href="index.php">Data Barang</a> |
    <a href="tampil_customer.php">Data Customer</a> |
    <b><a href="tampil_supplier.php">Data Supplier</a></b> |
    <a href="logout.php">Logout</a>
</p>
<hr/>

<form method="get" style="display:inline-block;">
    <input type="text" name="cari" placeholder="Cari Nama Supplier">
    <input type="submit" value="Cari">
</form>

<br><br>

<a href="tambah_supplier.php"><button>Tambah Data Supplier</button></a>&nbsp;&nbsp;
<a href="cetak_supplier.php" target="_BLANK"><button>Print Data Supplier</button></a>

<?php if (!empty($pesan_cari)) { echo "<p>".$pesan_cari."</p>"; } ?>

<table border="1">
    <tr>
        <th>ID Supplier</th>
        <th>Nama Supplier</th>
        <th>Alamat Supplier</th>
        <th>Telepon Supplier</th>
        <th>Email Supplier</th>
        <th>Password Supplier</th>
        <th>Action</th>
    </tr>
    <?php
    if(!empty($data_supplier)){
        foreach($data_supplier as $row){
        ?>
        <tr>
            <td><?php echo $row['id_supplier']; ?></td>
            <td><?php echo $row['nama_supplier']; ?></td>
            <td><?php echo $row['alamat_supplier']; ?></td>
            <td><?php echo $row['telepon_supplier']; ?></td>
            <td><?php echo $row['email_supplier']; ?></td>
            <td>********</td>
            <td>
                <a href="edit_supplier.php?id_supplier=<?php echo $row['id_supplier']; ?>&action=edit">Edit</a>
                <a href="proses_supplier.php?id_supplier=<?php echo $row['id_supplier']; ?>&action=delete">Hapus</a>
            </td>
        </tr>
        <?php
        }
    } else {
        echo "<tr><td colspan='7'>Data Supplier tidak ditemukan.</td></tr>";
    }
    ?>
</table>
<form method="get" action="cetak_satuan_supplier.php" target="_blank" style="margin-top:20px;">
    <input type="text" name="id_supplier" placeholder="Masukkan ID Supplier">
    <input type="submit" value="Print Satuan Supplier">
</form>

<br/>
<a href="logout.php"><button>Keluar Aplikasi</button></a>

</body>
</html>