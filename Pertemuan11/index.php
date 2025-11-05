<?php
// START: Proteksi Sesi dan Include Model
session_start();
// Pastikan semua file CRUD terproteksi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php'); // Model untuk Barang
$db = new database();

// Logic Pencarian Barang
if(isset($_GET['cari'])){
    $keyword = $_GET['cari'];
    // Memanggil fungsi cari_data dari koneksi.php
    $data_barang = $db->cari_data($keyword); 
    $pesan_cari = "Hasil pencarian : " . $keyword;
} else {
    // Jika tidak ada, tampilkan semua data
    $data_barang = $db->tampil_data(); 
    $pesan_cari = "";
}

$koneksi = mysqli_connect("localhost","root","","belajar_oop");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Barang</title>
</head>
<body>

<p>
    <a href="index.php">Beranda</a> | 
    <b><a href="index.php">Data Barang</a></b> | 
    <a href="tampil_customer.php">Data Customer</a> | 
    <a href="tampil_supplier.php">Data Supplier</a> | 
    <a href="logout.php">Logout</a>
</p>
<hr/>

<form method="get" style="display:inline-block;">
    <input type="text" name="cari" placeholder="Cari Nama Barang">
    <input type="submit" value="Cari">
</form>

<br>

<a href="tambah_data.php"><button>Tambah Data</button></a>&nbsp;&nbsp;
<a href="cetak.php" target="_BLANK"><button>Print Data Barang</button></a>

<?php if (!empty($pesan_cari)) { echo "<p>".$pesan_cari."</p>"; } ?>

<table border="1">
    <tr>
        <th>No</th><th>Kode Barang</th><th>Barang</th><th>Stok</th>
        <th>Harga Beli</th><th>Harga Jual</th><th>Action</th>
    </tr>
    <?php
    $no = 1;
    if(!empty($data_barang)){
        foreach($data_barang as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kd_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['harga_beli']; ?></td>
            <td><?php echo $row['harga_jual']; ?></td>
            <td>
                <a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>&action=edit">Edit</a>
                <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete">Hapus</a>
            </td>
        </tr>
        <?php
        }
    } else {
        echo "<tr><td colspan='7'>Data tidak ditemukan.</td></tr>";
    }
    ?>
</table>

<form method="get" action="cetak_satuan.php" target="_blank" style="margin-top:20px; display:inline-block;">
    <input type="text" name="kd_barang" placeholder="Masukkan Kode Barang">
    <input type="submit" value="Print Satuan Barang">
</form>

<br/>
<a href="logout.php"><button>Keluar Aplikasi</button></a>

</body>
</html>