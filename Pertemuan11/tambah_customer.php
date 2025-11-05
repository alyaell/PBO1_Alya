<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// Include koneksi_customer
include('koneksi_customer.php');
$db = new database_customer();

// Logic untuk membuat ID Customer otomatis
$id_customer_baru = $db->generate_id_customer(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Customer</title>
</head>
<body>

<p>
    <a href="index.php">Beranda</a> |
    <a href="index.php">Data Barang</a> |
    <b><a href="tampil_customer.php">Data Customer</a></b> |
    <a href="tampil_supplier.php">Data Supplier</a> |
    <a href="logout.php">Logout</a>
</p>
<hr/>
    
    <h3>Form Tambah Data Customer</h3>
    <hr/>
    <form method="post" action="proses_customer.php?action=add">
    <table>
        <tr>
            <td>ID Customer</td>
            <td>:</td>
            <td><input type="text" name="id_customer" value="<?php echo $id_customer_baru; ?>" readonly/></td>
        </tr>
        <tr>
            <td>NIK Customer</td>
            <td>:</td>
            <td><input type="text" name="nik_customer" required/></td>
        </tr>
        <tr>
            <td>Nama Customer</td>
            <td>:</td>
            <td><input type="text" name="nama_customer" required/></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
                <input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki
                <input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
            </td>
        </tr>
        <tr>
            <td>Alamat Customer</td>
            <td>:</td>
            <td><input type="text" name="alamat_customer" required/></td>
        </tr>
        <tr>
            <td>Telepon Customer</td>
            <td>:</td>
            <td><input type="text" name="telepon_customer" required/></td>
        </tr>
        <tr>
            <td>Email Customer</td>
            <td>:</td>
            <td><input type="email" name="email_customer" required/></td>
        </tr>
        <tr>
            <td>Password Customer</td>
            <td>:</td>
            <td><input type="password" name="pass_customer" required/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" name="tombol" value="Simpan"/>
                <a href="tampil_customer.php">
                    <input type="button" name="tombol" value="Kembali"/>
                </a>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>