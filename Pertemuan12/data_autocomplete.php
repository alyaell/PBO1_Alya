<?php
// data_autocomplete.php

header('Content-Type: application/json');
include('koneksi.php');
$db = new database();

$query = $_GET['query'] ?? '';
$suggestions = [];

if (!empty($query)) {
    $query_clean = mysqli_real_escape_string($db->koneksi, $query);

    // KOREKSI: Gunakan kriteria pencarian yang lebih kuat, 
    // seperti mencari dari awal kata (misal: 'Xiaomi')
    // kita akan pertahankan '%{$query_clean}%' untuk pencarian fleksibel
    
    $sql = "SELECT nama_barang FROM tb_barang WHERE nama_barang LIKE '%{$query_clean}%' LIMIT 10";
    $result = mysqli_query($db->koneksi, $sql);

    // ... (Logika Proses Hasil Query tetap sama)
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = [
                'value' => $row['nama_barang'],
                'data' => $row['nama_barang'] 
            ];
        }
    }
}

echo json_encode([
    'suggestions' => $suggestions
]);

// ... (Akhir Kode)