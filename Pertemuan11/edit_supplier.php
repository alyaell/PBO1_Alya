<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// 1. Include Model Supplier
include('koneksi_supplier.php');
$db = new database_supplier();

// 2. Ambil ID Supplier dari URL
$id_supplier = $_GET['id_supplier'];

// 3. Panggil method tampil_edit_data dari Model Supplier
$data_edit_supplier = $db->tampil_edit_data($id_supplier);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
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
    
    <h3>Form Edit Data Supplier</h3>
    <hr/>

    <form method="post" action="proses_supplier.php?action=edit">

    <?php
    // Loop untuk menampilkan data yang akan diedit
    foreach($data_edit_supplier as $d){
    ?>
    <table>
        <tr>
            <td>ID Supplier</td>
            <td>:</td>
            <td>
                <input type="hidden" name="id_supplier" value="<?php echo $d['id_supplier']; ?>"/>
                <input type="text" value="<?php echo $d['id_supplier']; ?>" readonly/> 
            </td>
        </tr>
        <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td><input type="text" name="nama_supplier" value="<?php echo $d['nama_supplier']; ?>"/></td>
        </tr>
        <tr>
            <td>Alamat Supplier</td>
            <td>:</td>
            <td><input type="text" name="alamat_supplier" value="<?php echo $d['alamat_supplier']; ?>"/></td>
        </tr>
        <tr>
            <td>Telepon Supplier</td>
            <td>:</td>
            <td><input type="text" name="telepon_supplier" value="<?php echo $d['telepon_supplier']; ?>"/></td>
        </tr>
        <tr>
            <td>Email Supplier</td>
            <td>:</td>
            <td><input type="email" name="email_supplier" value="<?php echo $d['email_supplier']; ?>"/></td>
        </tr>
        <tr>
            <td>Password Supplier</td>
            <td>:</td>
            <td><input type="text" name="pass_supplier" value="<?php echo $d['pass_supplier']; ?>"/></td> 
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" name="tombol" value="Ubah"/>
                <a href="tampil_supplier.php">
                    <input type="button" name="tombol" value="Kembali"/>
                </a>
            </td>
        </tr>
    </table>
    <?php
    }
    ?>
    </form>
</body>
</html>