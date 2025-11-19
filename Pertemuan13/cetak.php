<?php
// Step 8 – Perancangan Struktur File (Coding File cetak.php untuk Pencetakan Laporan)

// Sertakan file Model/Koneksi
include('koneksi.php');

// Buat instance/objek dari kelas database (Model)
$db = new database();

// Ambil semua data barang
$data_barang = $db->tampil_data();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang</title>
    
    <style type="text/css">
        /* Mengatur margin body untuk tampilan laporan */
        body {
            margin: 0px 230px;
            color: black;
            font-family: sans-serif;
            font-size: 12pt;
        }

        /* Styling Heading */
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Styling Tabel */
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        
        /* Menyembunyikan elemen yang tidak perlu dicetak (opsional) */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <h2>LAPORAN DATA BARANG CV JAYA</h2>

    <table width="667" border="1">
        <thead>
            <tr>
                <th width="21">No</th>
                <th width="122">Kode Barang</th>
                <th width="190">Nama Barang</th>
                <th width="67">Stok</th>
                <th width="78">Harga Beli</th>
                <th width="83">Harga Jual</th>
                <th width="114">Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // Looping untuk menampilkan data barang
            foreach ($data_barang as $row) {
                // Menghitung Keuntungan
                $keuntungan = $row['harga_jual'] - $row['harga_beli'];
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['kd_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                <td><?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                <td><?php echo number_format($keuntungan, 0, ',', '.'); ?></td>
            </tr>
            <?php 
            }
            // Penutup foreach
            ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>