<!DOCTYPE html>
<html>
<head>
    <title>Membuat CRUD Dengan PHP Dan MySQL Menampilkan data dari database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="judul">
        <h1>Membuat CRUD Dengan PHP Dan MySQL</h1>
        <h2>Menampilkan data dari database</h2>
    </div>
    <br/>
    
    <!-- ===== NAVIGATION BAR ===== -->
  <nav class="menu">
    <div class="container">
      <ul>
        <li><a href="index.php">Home</a></li>

        <li><a href="#">Data Master</a>
          <ul>
            <li><a href="user.php">Data User</a></li>
            <li><a href="barang.php">Data Barang</a></li>
            <li><a href="customer.php">Data Customer</a></li>
            <li><a href="supplier.php">Data Supplier</a></li>
          </ul>
        </li>

        <li><a href="#">Data Transaksi</a>
          <ul>
            <li><a href="pembelian.php">Transaksi Pembelian</a></li>
            <li><a href="penjualan.php">Transaksi Penjualan</a></li>
          </ul>
        </li>

        <li><a href="#">Laporan</a>
          <ul>
            <li><a href="laporan_barang.php">Laporan Data Barang</a></li>
            <li><a href="laporan_customer.php">Laporan Data Customer</a></li>
            <li><a href="laporan_supplier.php">Laporan Data Supplier</a></li>
            <li><a href="laporan_pembelian.php">Laporan Transaksi Pembelian</a></li>
            <li><a href="laporan_penjualan.php">Laporan Transaksi Penjualan</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- ===== ISI HALAMAN (HOME) ===== -->
  <div class="container">
    <h3>Selamat datang di Sistem CRUD PHP & MySQL</h3>
    <p>Pilih menu di atas untuk mengelola data master, transaksi, atau melihat laporan.</p>
  </div>
    
    <?php
    if(isset($_GET['pesan'])){
        $pesan = $_GET['pesan'];
        if($pesan == "input"){
            echo "Data berhasil di input.";
        }else if($pesan == "update"){
            echo "Data berhasil di update.";
        }else if($pesan == "hapus"){
            echo "Data berhasil di hapus.";
        }
    }
    ?>
    
    <br/>
    <a class="tombol" href="input.php">+ Tambah Data Baru</a>
    
    <h3>Data user</h3>
    <table border="1" class="table">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Pekerjaan</th>
            <th>Opsi</th>
        </tr>
        
        <?php
        include "koneksi.php";
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM user"); 
        $nomor = 1;
        while($data = mysqli_fetch_array($query_mysql)){
        ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['pekerjaan']; ?></td>
            <td>
                <a class="edit" href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> |
                <a class="hapus" href="hapus.php?id=<?php echo $data['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>

