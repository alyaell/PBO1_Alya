<?php
// Step 7 – Perancangan Struktur File (Coding File edit_data.php sebagai view)

// Sertakan file Model/Koneksi
include('koneksi.php');

// Buat instance/objek dari kelas database (Model)
$db = new database();

// 1. Ambil ID Barang dari URL
$id_barang = $_GET['id_barang'];

// 2. Ambil data barang lama berdasarkan ID
// Asumsi: Method tampil_data_by_id mengembalikan data dalam format array asosiatif
$data_edit_barang = $db->tampil_data_by_id($id_barang);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data Barang</title>
    
    <style type="text/css">
        /* Global Styling */
        * {
            font-family: "Trebuchet MS", sans-serif;
        }

        /* Styling Body/Container */
        body {
            margin: 0px 500px;
            color: black;
        }
        
        /* Heading */
        h3 {
            text-transform: uppercase;
            color: #47C0DB;
            text-align: center;
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
        .tombol_login { /* Digunakan untuk tombol Ubah dan Kembali */
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
        
    </style>
</head>

<body>
    <center><h3>Form Edit Data Barang</h3></center>

    <form method="post" action="proses_barang.php?action=edit&id_barang=<?php echo $data_edit_barang['id_barang']; ?>" enctype="multipart/form-data">
        <table width="60%" border="0" align="center">
            <tbody>
                
                <tr>
                    <td width="30%">Kode Barang</td>
                    <td width="5%">:</td>
                    <td width="65%">
                        <input type="hidden" name="id_barang" value="<?php echo $data_edit_barang['id_barang']; ?>"/>
                        <input type="text" name="kd_barang" value="<?php echo $data_edit_barang['kd_barang']; ?>" readonly="readonly"/>
                    </td>
                </tr>

                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td><input type="text" name="nama_barang" value="<?php echo $data_edit_barang['nama_barang']; ?>" required/></td>
                </tr>

                <tr>
                    <td>Stok</td>
                    <td>:</td>
                    <td><input type="text" name="stok" value="<?php echo $data_edit_barang['stok']; ?>" required/></td>
                </tr>

                <tr>
                    <td>Harga Beli</td>
                    <td>:</td>
                    <td><input type="text" name="harga_beli" value="<?php echo $data_edit_barang['harga_beli']; ?>" required/></td>
                </tr>

                <tr>
                    <td>Harga Jual</td>
                    <td>:</td>
                    <td><input type="text" name="harga_jual" value="<?php echo $data_edit_barang['harga_jual']; ?>" required/></td>
                </tr>

                <tr>
                    <td>Gambar Barang</td>
                    <td>:</td>
                    <td>
                        <img src="gambar/<?php echo $data_edit_barang['gambar_produk']; ?>" style="width: 150px; float: left; margin-right: 15px; margin-bottom: 5px;"/>
                        
                        <input type="file" name="gambar_produk"/>
                        
                        <p style="color: red; font-size: 12px; float: left;">Biarkan kosong jika tidak merubah gambar produk!</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" height="40"></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="tombol" class="tombol_login" value="Ubah"/>
                        
                        <a href="tampil.php" class="tombol_login" style="background-color: #ccc;">Kembali</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>