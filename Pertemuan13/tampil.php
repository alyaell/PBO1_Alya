<?php
// Tampil.php sebagai View dan Delete Data
session_start();
// Cek apakah user sudah login atau belum (Pengamanan)
if (!isset($_SESSION['user'])) {
    header('location:index.php');
    exit;
}

// Sertakan file Model/Koneksi
include('koneksi.php');

// Buat instance/objek dari kelas database (Model)
$db = new database();

// ===================================================
// LOGIKA PAGINATION
// ===================================================
$data_per_halaman = 5; // Tentukan berapa data per halaman
$total_data = $db->count_all_data();
$total_halaman = ceil($total_data / $data_per_halaman);
// PENTING: Jika ada pencarian, halaman aktif akan diabaikan dan kembali ke 1.
$halaman_aktif = (isset($_GET['halaman']) && !isset($_GET['cart'])) ? (int)$_GET['halaman'] : 1; 

// Pastikan halaman aktif valid
if ($halaman_aktif < 1) {
    $halaman_aktif = 1;
}
if ($halaman_aktif > $total_halaman && $total_halaman > 0) {
    $halaman_aktif = $total_halaman;
}

// Hitung OFFSET (Data dimulai dari mana)
$offset = ($halaman_aktif - 1) * $data_per_halaman;
// ===================================================
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
            box-sizing: border-box; 
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
            text-align: left;
            margin-bottom: 20px;
        }
        
        /* Kontainer Tombol Aksi */
        .posisi_tombol {
            margin-bottom: 20px;
            display: flex; 
            gap: 10px;
        }

        /* Form Pencarian */
        .formBackground_border {
            margin: 10px 0; 
            padding: 10px 0; 
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
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

        /* Styling Navbar */
        .navbar {
            background-color: #47C0DB; 
            padding: 10px var(--left-indent);
            margin: -20px calc(-1 * var(--left-indent)) 20px calc(-1 * var(--left-indent)); 
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            float: left;
        }

        .navbar ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 10px 15px;
            text-decoration: none;
            background-color: transparent; 
            margin: 0; 
            border-radius: 0; 
            font-size: 14px;
        }

        .navbar ul li a:hover {
            background-color: #3AA8C0; 
        }

        /* =================================================== */
        /* PERBAIKAN STYLING AUTOCOMPLETE (DIPERTAHANKAN) */
        /* =================================================== */
        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            z-index: 9999; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Hapus styling global 'a' yang menempel pada saran */
        .autocomplete-suggestions .autocomplete-suggestion {
            background: none !important;
            color: #333 !important;
            padding: 5px 10px !important;
            margin: 0 !important;
            border-radius: 0 !important;
            display: block !important;
            cursor: pointer;
            text-decoration: none;
            line-height: normal;
            font-size: 13px;
        }

        /* Styling saat saran di-hover/dipilih */
        .autocomplete-suggestions .autocomplete-selected {
            background: #DDEFEF !important; 
        }
        /* =================================================== */
    </style>
</head>

<body>
    <div class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="tampil.php">Kelola Data</a></li>
            <li><a href="proses_barang.php?action=logout">Logout</a></li>
        </ul>
    </div>
    <h1>DATA BARANG</h1>
    
    <div class="formBackground_border">
        <form style="display: inline-block;" method="get">
            Cari berdasarkan :
            <select name="kriteria">
                <option value="kd_barang">Kode Barang</option>
                <option value="nama_barang">Nama Barang</option>
                <option value="stok">Stok</option>
                <option value="harga_beli">Harga Beli</option>
                <option value="harga_jual">Harga Jual</option>
            </select>
            
            <input type="text" name="cart" id="autocart" placeholder="Cari Data" 
                   value="<?php echo isset($_GET['cart']) ? htmlspecialchars($_GET['cart']) : ''; ?>">
            
            <input type="submit" name="Submit" class="tombol_login" value="Cari Data">
        </form>
    </div>

    <div class="posisi_tombol">
        <a href="tambah_data.php">Tambah Data Barang</a>
        <a href="cetak.php" target="_blank">Print Data Barang</a>
    </div>
    
    
    <?php 
    $is_searching = isset($_GET['cart']) && !empty($_GET['cart']); // Cek apakah mode pencarian aktif

    if ($is_searching) {
        $cart = $_GET['cart'];
        echo "<br>Hasil pencarian: " . htmlspecialchars($cart);
    } 
    ?>
    
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
            // LOGIKA PENGAMBILAN DATA (DIPERBAIKI)
            if ($is_searching) {
                // Mode Pencarian (Tidak dipaginasi)
                $cart = $_GET['cart'];
                $kriteria = $_GET['kriteria'];
                $data_barang = $db->cari_data($cart, $kriteria); 
                
                $no = 1; // Nomor urut selalu dimulai dari 1 saat pencarian
                
            } else {
                // Mode Normal (Dipaginasi)
                $data_barang = $db->tampil_data($data_per_halaman, $offset);
                $no = $offset + 1; // Sesuaikan nomor urut berdasarkan offset
            }

            // Looping untuk menampilkan setiap baris data
            foreach ($data_barang as $row) {
                // Format angka menjadi Rupiah (tanpa desimal ganda)
                $rupiah_harga_beli = "Rp " . number_format($row['harga_beli'], 0, ',', '.');
                $rupiah_harga_jual = "Rp " . number_format($row['harga_jual'], 0, ',', '.');
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['kd_barang']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($row['stok']); ?></td>
                <td><?php echo $rupiah_harga_beli; ?></td>
                <td><?php echo $rupiah_harga_jual; ?></td>
                
                <td style="text-align: center">
                    <img src="gambar/<?php echo htmlspecialchars($row['gambar_produk']); ?>" style="width: 50px;"/>
                </td>
                
                <td>
                    <a href="edit_data.php?id_barang=<?php echo htmlspecialchars($row['id_barang']); ?>" style="padding: 5px 8px;">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo htmlspecialchars($row['id_barang']); ?>&action=delete" style="padding: 5px 8px; background-color: #f44336;">Hapus</a>
                </td>
            </tr>
            <?php 
            }
            if (empty($data_barang) && $is_searching) {
                echo '<tr><td colspan="8" style="text-align:center;">Data yang dicari tidak ditemukan!</td></tr>';
            } else if (empty($data_barang)) {
                echo '<tr><td colspan="8" style="text-align:center;">Tidak ada data barang.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 20px;">
        
        <?php 
            // Tampilkan pagination hanya jika TIDAK dalam mode pencarian
            if (!$is_searching && $total_halaman > 1): 
                
                // Variabel untuk menyimpan parameter GET lainnya jika ada
                $q_param = ''; 
        ?>

            <?php if ($halaman_aktif > 1): ?>
                <a href="?halaman=<?php echo $halaman_aktif - 1 . $q_param; ?>" style="background-color: #888;">Previous</a>
            <?php else: ?>
                <span style="padding: 10px; background-color: #eee; color: #aaa; border-radius: 3px;">Previous</span>
            <?php endif; ?>

            <?php for($i = 1; $i <= $total_halaman; $i++): ?>
                <?php if ($i == $halaman_aktif): ?>
                    <a href="?halaman=<?php echo $i . $q_param; ?>" style="background-color: orange; color: white;">**<?php echo $i; ?>**</a>
                <?php else: ?>
                    <a href="?halaman=<?php echo $i . $q_param; ?>" style="background-color: #ccc;"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halaman_aktif < $total_halaman): ?>
                <a href="?halaman=<?php echo $halaman_aktif + 1 . $q_param; ?>" style="background-color: #888;">Next</a>
            <?php else: ?>
                <span style="padding: 10px; background-color: #eee; color: #aaa; border-radius: 3px;">Next</span>
            <?php endif; ?>

        <?php endif; ?>
        
    </div>
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
                // Saat dipilih, form akan otomatis ter-submit dan data akan dicari.
                $(this).closest('form').submit(); 
            }
        });
        
        // Opsional: Perlebar Input Field
        $('#autocart').css('width', '250px');
    });
    </script>
</body>
</html>