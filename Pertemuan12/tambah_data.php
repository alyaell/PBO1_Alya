<?php
// Step 6 – Perancangan Struktur File (Coding File tambah_data.php sebagai view)

// Sertakan file Model/Koneksi
include('koneksi.php');

// Buat instance/objek dari kelas database (Model)
// Asumsi: Nama kelas di file koneksi.php adalah 'database'
$db = new database();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Data Barang</title>
    
    <style type="text/css">
        /* Global Styling */
        * {
            font-family: "Trebuchet MS", sans-serif;
        }

        /* Styling Form Border (untuk Body / Container) */
        body {
            margin: 0px 500px;
            color: black;
        }
        
        /* Tambahkan style untuk formBackground_border jika form Anda di-wrap */
        .formBackground_border {
            margin: 0px 500px;
            color: black;
        }

        /* Styling Tabel Form */
        table {
            border: solid 1px #DDDDDD;
            border-collapse: collapse;
            border-spacing: 0;
            width: 90%; /* Lebar tabel form */
            margin: 10px auto;
        }
        
        table td {
            padding: 10px;
        }
        
        /* Input Field Styling */
        input[type="text"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Styling Tombol */
        .tombol_login { /* Digunakan untuk tombol Simpan dan Reset */
            background: #47C0DB;
            color: white;
            font-size: 12px;
            border: none;
            padding: 5px 20px;
            cursor: pointer;
            margin-right: 10px;
        }
        
        /* Styling Link */
        a {
            background-color: #47C0DB;
            color: #ffff;
            padding: 5px 10px;
            text-decoration: none;
            font-size: 12px;
            border-radius: 4px;
        }
        
        /* Heading */
        h3 {
            text-transform: uppercase;
            color: #47C0DB;
            text-align: center;
        }

    </style>
</head>
<body>
    <?php
    // Logika untuk membuat Kode Barang Otomatis
    $kd_barang = $db->kode_barang(); // Asumsi method kode_barang() ada di kelas database
    
    // Logika pemisahan kode barang (Jika kode barang = BRG001, maka $kode_barang_baru = BRG001)
    $specdata = explode(',', $kd_barang);
    $kode_barang_baru = $specdata[0];
    ?>

    <center><h3>Form Tambah Data Barang</h3></center>

    <form name="form_tambah" method="post" action="proses_barang.php?action=add" enctype="multipart/form-data">
        <table width="60%" border="0" align="center">
            <tbody>
                <tr height="40">
                    <td width="30%">Kode Barang</td>
                    <td width="5%">:</td>
                    <td width="65%">
                        <input type="text" name="kd_barang" value="<?php echo $kode_barang_baru; ?>" readonly="readonly"/>
                    </td>
                </tr>

                <tr height="40">
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td><input type="text" name="nama_barang" placeholder="Nama Barang" required/></td>
                </tr>

                <tr height="40">
                    <td>Stok</td>
                    <td>:</td>
                    <td><input type="text" name="stok" placeholder="Stok" required/></td>
                </tr>

                <tr height="40">
                    <td>Harga Beli</td>
                    <td>:</td>
                    <td><input type="text" name="harga_beli" placeholder="Harga Beli" required/></td>
                </tr>

                <tr height="40">
                    <td>Harga Jual</td>
                    <td>:</td>
                    <td><input type="text" name="harga_jual" placeholder="Harga Jual" required/></td>
                </tr>

                <tr height="40">
                    <td>Gambar Barang</td>
                    <td>:</td>
                    <td>
                        <input type="file" name="gambar_produk" required="required"/>
                        <p style="color: red; font-size: 12px;">Ekstensi yang diperbolehkan: .png | .jpg | .jpeg | .gif</p>
                    </td>
                </tr>

                <tr height="40">
                    <td colspan="3" height="40"></td>
                </tr>

                <tr height="40">
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="tombol" class="tombol_login" value="Simpan"/>
                        
                        <a href="tampil.php" class="tombol_login" style="background-color: #ccc;">Kembali</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>