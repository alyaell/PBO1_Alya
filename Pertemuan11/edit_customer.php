<?php
session_start();
// Proteksi sesi
if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

// 1. Include Model Customer
include('koneksi_customer.php');
$db = new database_customer();

// 2. Ambil ID Customer dari URL
$id_customer = $_GET['id_customer'];

// 3. Panggil method tampil_edit_data dari Model Customer
$data_edit_customer = $db->tampil_edit_data($id_customer);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Customer</title>
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
    
    <h3>Form Edit Data Customer</h3>
    <hr/>

    <form method="post" action="proses_customer.php?action=edit">

    <?php
    // Loop (walaupun hanya 1 data) untuk menampilkan data
    foreach($data_edit_customer as $d){
    ?>
    <table>
        <tr>
            <td>ID Customer</td>
            <td>:</td>
            <td>
                <input type="hidden" name="id_customer" value="<?php echo $d['id_customer']; ?>"/>
                <input type="text" value="<?php echo $d['id_customer']; ?>" readonly/> 
            </td>
        </tr>
        <tr>
            <td>NIK Customer</td>
            <td>:</td>
            <td><input type="text" name="nik_customer" value="<?php echo $d['nik_customer']; ?>"/></td>
        </tr>
        <tr>
            <td>Nama Customer</td>
            <td>:</td>
            <td><input type="text" name="nama_customer" value="<?php echo $d['nama_customer']; ?>"/></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
                <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php if($d['jenis_kelamin']=='Laki-laki') echo 'checked'; ?>> Laki-laki
                <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if($d['jenis_kelamin']=='Perempuan') echo 'checked'; ?>> Perempuan
            </td>
        </tr>
        <tr>
            <td>Alamat Customer</td>
            <td>:</td>
            <td><input type="text" name="alamat_customer" value="<?php echo $d['alamat_customer']; ?>"/></td>
        </tr>
        <tr>
            <td>Telepon Customer</td>
            <td>:</td>
            <td><input type="text" name="telepon_customer" value="<?php echo $d['telepon_customer']; ?>"/></td>
        </tr>
        <tr>
            <td>Email Customer</td>
            <td>:</td>
            <td><input type="email" name="email_customer" value="<?php echo $d['email_customer']; ?>"/></td>
        </tr>
        <tr>
            <td>Password Customer</td>
            <td>:</td>
            <td><input type="text" name="pass_customer" value="<?php echo $d['pass_customer']; ?>"/></td> 
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" name="tombol" value="Ubah"/>
                <a href="tampil_customer.php">
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