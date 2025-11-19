<?php
// Step 4 – Perancangan Struktur File (Coding File proses_barang.php sebagai controller)

// 1. Sertakan file Model (Koneksi.php)
include('koneksi.php');

// 2. Buat instance/objek dari kelas database (Model)
// Asumsi: Nama kelas di file koneksi.php adalah 'database'
$koneksi = new database();

// 3. Ambil nilai action dari URL untuk menentukan operasi (add, edit, delete, dll.)
$action = $_GET['action'];

// -------------------------------------------------------------------
// OPERASI CRUD UNTUK BARANG
// -------------------------------------------------------------------

// Action: Tambah Data Baru (CREATE)
if ($action == "add") {
    // Panggil method simpan_data dari Model
    // Parameter pertama ID_BARANG diset null/kosong untuk menandakan mode INSERT/ADD
    $koneksi->simpan_data(
        null, // Parameter pertama: ID_BARANG diset NULL/kosong
        $_POST['kd_barang'],
        $_POST['nama_barang'],
        $_POST['stok'],
        $_POST['harga_beli'],
        $_POST['harga_jual']
        // Parameter $_FILES['gambar_produk']['name'] DIHAPUS karena Model mengakses $_FILES global
    );
}

// Action: Edit Data (UPDATE)
else if ($action == "edit") {
    $id_barang = $_GET['id_barang'];
    
    // Panggil method simpan_data dari Model (Koreksi nama method)
    // Parameter pertama ID_BARANG diisi untuk menandakan mode UPDATE/EDIT
    $koneksi->simpan_data( // DIGANTI: dari edit_data menjadi simpan_data
        $id_barang, // Parameter pertama: ID_BARANG diisi
        $_POST['kd_barang'],
        $_POST['nama_barang'],
        $_POST['stok'],
        $_POST['harga_beli'],
        $_POST['harga_jual']
        // Parameter $_FILES['gambar_produk']['name'] DIHAPUS karena Model mengakses $_FILES global
    );
}

// Action: Hapus Data (DELETE)
else if ($action == "delete") {
    $id_barang = $_GET['id_barang'];
    
    // Panggil method delete_data dari Model (Nama method ini sudah benar)
    $koneksi->delete_data($id_barang);
}

// -------------------------------------------------------------------
// OPERASI LAINNYA
// -------------------------------------------------------------------

// Action: Print Satuan (Contoh Operasi Tambahan)
else if ($action == "print_satuan") {
    $nama_barang = $_POST['nama_barang'];
    
    // Panggil method satuan_print dari Model
    $koneksi->satuan_print($nama_barang);
    
    // Redirect ke halaman cetak
    header('location:cetak2.php?nama_barang=' . $nama_barang);
}

// Action: Login
else if ($action == "login") {
    // Panggil method login dari Model
    $koneksi->login($_POST['username'], $_POST['password']);
}

// Action: Logout
else if ($action == "logout") {
    // Panggil method logout dari Model
    $koneksi->logout();
}

?>