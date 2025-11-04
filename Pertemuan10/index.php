<?php
session_start();
// --- PROTEKSI SESSION ---
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
}
include("koneksi.php");
$db = new database();
$data_barang = $db->tampil_data();
$koneksi = mysqli_connect("localhost","root","","belajar_oop");
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
.form_background_border{
  margin: 0px 230px;
  color:white;
}
</style>
</head>
<body>
    <form action="tambah_data.php" method="post" style="display:inline;">
        <button type="submit">Tambah Data</button>
    </form>
  <form id="form_background_border" method="get">
    <input type="text" name="cari" placeholder="Cari Nama Barang">
    <input type="submit" value="Cari">
  </form>
  <?php
  if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    echo "<b>Hasil pencarian : ".$cari."</b>";
  }
  ?>

  <table border="1">
    <tr>
      <th>No</th>
      <th>Barang</th>
      <th>Stok</th>
      <th>Harga Beli</th>
      <th>Harga Jual</th>
      <th>Action</th>
    </tr>
    <?php
    $i=0;
    foreach($data_barang as $row){
      $i++;
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['nama_barang'];?></td>
      <td><?php echo $row['stok'];?></td>
      <td><?php echo $row['harga_beli'];?></td>
      <td><?php echo $row['harga_jual'];?></td>
      <td>
        <a href="edit_data.php?id_barang=<?php echo $row['id_barang'];?>&action=edit">Edit</a>
        <a href="proses_barang.php?id_barang=<?php echo $row['id_barang'];?>&action=delete">Hapus</a>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
<br/>
<form action="logout.php" method="post" style="display:inline;">
    <button type="submit">Keluar Aplikasi</button>
</form>
</body>
</html>