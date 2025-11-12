<?php
// Tampil.php sebagai View dan Delete Data

// Sertakan file Model/Koneksi
include('koneksi.php');

// Buat instance/objek dari kelas database (Model)
// Asumsi: Nama kelas di file koneksi.php adalah 'database'
$db = new database();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    <title>DATA BARANG</title>
    
    <style type="text/css">
        /* Konstanta Jarak Kiri agar semua elemen rata */
        :root {
            --left-indent: 50px;
        }
        
        /* Global Reset */
        * {
            font-family: "Trebuchet MS", sans-serif;
            box-sizing: border-box; /* Tambahkan box-sizing untuk tata letak yang konsisten */
        }
        
        /* Body Styling */
        body {
            margin: 20px 0; 
            padding-left: var(--left-indent); 
            padding-right: var(--left-indent); 
        }

        /* Heading 1 */
        h1 {
            text-transform: uppercase;
            color: #47C0DB;
            text-align: left; /* Pastikan judul rata kiri */
            margin-bottom: 20px;
        }
        
        /* Kontainer Tombol Aksi */
        .posisi_tombol {
            margin-bottom: 20px;
        }

        /* Form Pencarian */
        .formBackground_border {
            margin: 10px 0; 
            padding: 10px 0; 
        }
        
        /* Table Styling */
        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 95%; 
            margin: 10px 0 10px 0; 
        }

        table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
            text-decoration: none;
        }

        table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
        
        /* Tombol dan Link */
        .tombol_login {
            background: #47C0DB;
            color: white;
            font-size: 11pt;
            border: none;
            padding: 5px 20px;
            cursor: pointer;
        }

        a {
            background-color: #47C0DB;
            color: #ffff;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
            display: inline-block;
            border-radius: 3px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="posisi_tombol">
        <a href="tambah_data.php">Tambah Data Barang</a>
        <a href="proses_barang.php?action=logout" style="background-color: #f44336;">Keluar Aplikasi</a>
        <a href="cetak.php" target="_blank">Print Data Barang</a>
    </div>

    <h1>DATA BARANG</h1>
    
    <form class="formBackground_border" method="get">
        Cari berdasarkan :
        <select name="kriteria">
            <option value="kd_barang">Kode Barang</option>
            <option value="nama_barang">Nama Barang</option>
            <option value="stok">Stok</option>
            <option value="harga_beli">Harga Beli</option>
            <option value="harga_jual">Harga Jual</option>
        </select>
        
        <input type="text" name="cart" id="autocart" placeholder="Cari Data">
        
        <input type="submit" name="Submit" class="tombol_login" value="Cari Data">
    </form>
    
    <?php if (isset($_GET['cart'])) {
        $cart = $_GET['cart'];
        echo "<br>Hasil pencarian: " . $cart;
    } ?>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Kode Barang</th>
                <th width="20%">Nama Barang</th>
                <th width="10%">Stok</th>
                <th width="15%">Harga Beli</th>
                <th width="15%">Harga Jual</th>
                <th width="15%">Gambar Produk</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Logika Pencarian
            if (isset($_GET['cart'])) {
                $cart = $_GET['cart'];
                $kriteria = $_GET['kriteria'];
                
                $data_barang = $db->cari_data($cart, $kriteria); 
                
            } else {
                $data_barang = $db->tampil_data();
            }

            $no = 1;
            // Looping untuk menampilkan setiap baris data
            foreach ($data_barang as $row) {
                // Format angka menjadi Rupiah (tanpa desimal ganda)
                $rupiah_harga_beli = "Rp " . number_format($row['harga_beli'], 0, ',', '.');
                $rupiah_harga_jual = "Rp " . number_format($row['harga_jual'], 0, ',', '.');
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['kd_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $rupiah_harga_beli; ?></td>
                <td><?php echo $rupiah_harga_jual; ?></td>
                
                <td style="text-align: center">
                    <img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 50px;"/>
                </td>
                
                <td>
                    <a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>" style="padding: 5px 8px;">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete" style="padding: 5px 8px; background-color: #f44336;">Hapus</a>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>

   <script src="jquery-3.2.1.min.js"></script>
    <script src="jquery.autocomplete.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        // PERIKSA: ID input harus "#autocart"
        $('#autocart').autocomplete({
            serviceUrl: 'data_autocomplete.php', 
            paramName: 'query', 
            width: 350, 
            
            // FUNGSI INI WAJIB ADA untuk klik otomatis
            onSelect: function (suggestion) {
                $(this).closest('form').submit(); 
            }
        });
        
        // Opsional: Perlebar Input Field
        $('#autocart').css('width', '250px');
    });
    </script>
</body>
</html>