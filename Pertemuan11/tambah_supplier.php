<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// Include koneksi_supplier
include('koneksi_supplier.php');
$db = new database_supplier();

// Logic untuk membuat ID Supplier otomatis
$id_supplier_baru = $db->generate_id_supplier(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Supplier</title>
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
    
    <h3>Form Tambah Data Supplier</h3>
    <hr/>
    <form method="post" action="proses_supplier.php?action=add">
    <table>
        <tr>
            <td>ID Supplier</td>
            <td>:</td>
            <td><input type="text" name="id_supplier" value="<?php echo $id_supplier_baru; ?>" readonly/></td>
        </tr>
        <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td><input type="text" name="nama_supplier" required/></td>
        </tr>
        <tr>
            <td>Alamat Supplier</td>
            <td>:</td>
            <td><input type="text" name="alamat_supplier" required/></td>
        </tr>
        <tr>
            <td>Telepon Supplier</td>
            <td>:</td>
            <td><input type="text" name="telepon_supplier" required/></td>
        </tr>
        <tr>
            <td>Email Supplier</td>
            <td>:</td>
            <td><input type="email" name="email_supplier" required/></td>
        </tr>
        <tr>
            <td>Password Supplier</td>
            <td>:</td>
            <td><input type="password" name="pass_supplier" required/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" name="tombol" value="Simpan"/>
                <a href="tampil_supplier.php">
                    <input type="button" name="tombol" value="Kembali"/>
                </a>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>