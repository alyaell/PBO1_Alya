<?php

// ===================================================
// Definisikan Class Model/Database
// ===================================================
class database {
    public $koneksi;

    // Method Constructor: Otomatis dipanggil saat 'new database()'
    public function __construct() {
        // Konfigurasi Database
        $hostname = "localhost";
        $database = "bljr_oop";
        $username = "root";
        $password = "";

        // Buat koneksi
        $this->koneksi = mysqli_connect($hostname, $username, $password, $database);
        
        // Cek koneksi
        if (mysqli_connect_errno()) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // ===================================================
    // Method READ (Tampil Data)
    // ===================================================

    // Method tampil semua data barang DENGAN PAGINATION (KODE BARU)
    // Tambahkan $limit dan $offset (default null)
    public function tampil_data($limit = null, $offset = 0) {
        $query = "SELECT * FROM tb_barang";
        
        // Tambahkan klausa LIMIT jika $limit ada
        if ($limit !== null) {
            // Gunakan LIMIT dan OFFSET
            $query .= " LIMIT $offset, $limit";
        }
        
        $result = mysqli_query($this->koneksi, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Method tampil data berdasarkan ID
    public function tampil_data_by_id($id_barang) {
        // Gunakan mysqli_real_escape_string untuk keamanan dasar
        $id_barang_clean = mysqli_real_escape_string($this->koneksi, $id_barang);
        $query = "SELECT * FROM tb_barang WHERE id_barang='$id_barang_clean'";
        $result = mysqli_query($this->koneksi, $query);
        return mysqli_fetch_assoc($result);
    }
    
    // Method untuk membuat Kode Barang Otomatis (BRG001, BRG002, dst.)
    public function kode_barang() {
        // Ambil kode barang maksimum
        $query = "SELECT MAX(kd_barang) AS kode_max FROM tb_barang";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        
        $kode_max = $data['kode_max'];
        
        // Proses urutan kode
        if ($kode_max) {
             $urutan = (int) substr($kode_max, 3, 3); 
        } else {
             $urutan = 0; // Mulai dari 0 jika tabel kosong
        }
        
        $urutan++;
        $huruf = "BRG";
        
        // Format angka menjadi 3 digit (misal: 1 menjadi 001)
        $kode_barang_baru = $huruf . sprintf("%03s", $urutan);
        
        return $kode_barang_baru;
    }

    // ===================================================
    // Method CREATE dan UPDATE (Digabung ke simpan_data)
    // ===================================================

    public function simpan_data($id_barang, $kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual) {
        
        // **PERBAIKAN KEAMANAN**: Bersihkan semua input data
        $id_barang_clean = mysqli_real_escape_string($this->koneksi, $id_barang);
        $kd_barang_clean = mysqli_real_escape_string($this->koneksi, $kd_barang);
        $nama_barang_clean = mysqli_real_escape_string($this->koneksi, $nama_barang);
        $stok_clean = mysqli_real_escape_string($this->koneksi, $stok);
        $harga_beli_clean = mysqli_real_escape_string($this->koneksi, $harga_beli);
        $harga_jual_clean = mysqli_real_escape_string($this->koneksi, $harga_jual);
        
        // Inisiasi data gambar
        $gambar_baru = $_FILES['gambar_produk']['name'] ?? null;
        $gambar_lama = !empty($id_barang_clean) ? $this->tampil_data_by_id($id_barang_clean)['gambar_produk'] : null;

        // Logika penanganan gambar
        if (empty($gambar_baru)) {
            // TIDAK ADA GAMBAR BARU: Pertahankan gambar lama
            $gambar_produk = $gambar_lama;
        } else {
            // ADA GAMBAR BARU: Lakukan Upload
            $nama_file = $_FILES['gambar_produk']['name'];
            $ekstensi_gambar = strtolower(end(explode('.', $nama_file)));

            // Validasi Ekstensi
            if (!in_array($ekstensi_gambar, ['jpg', 'jpeg', 'png', 'gif'])) {
                echo "<script>alert('File ekstensi tidak valid!'); window.location.href='tampil.php';</script>";
                return false;
            }

            // Upload dan Generate Nama Unik
            $tmp_file = $_FILES['gambar_produk']['tmp_name'];
            $gambar_produk = uniqid() . '.' . $ekstensi_gambar;

            move_uploaded_file($tmp_file, 'gambar/' . $gambar_produk);
            
            // Hapus gambar lama (jika mode UPDATE)
            if (!empty($gambar_lama) && $gambar_lama != 'default.png') {
                if (file_exists('gambar/' . $gambar_lama)) {
                    unlink('gambar/' . $gambar_lama);
                }
            }
        }
        
        // Penentuan Query (UPDATE atau INSERT)
        if (!empty($id_barang_clean)) {
            // MODE UPDATE
            $query = "UPDATE tb_barang SET 
                        kd_barang='$kd_barang_clean', 
                        nama_barang='$nama_barang_clean', 
                        stok='$stok_clean', 
                        harga_beli='$harga_beli_clean', 
                        harga_jual='$harga_jual_clean', 
                        gambar_produk='$gambar_produk'
                      WHERE id_barang='$id_barang_clean'";
            $msg_sukses = "Data berhasil diubah!";

        } else {
            // MODE INSERT
            $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) 
                      VALUES ('$kd_barang_clean', '$nama_barang_clean', '$stok_clean', '$harga_beli_clean', '$harga_jual_clean', '$gambar_produk')";
            $msg_sukses = "Data berhasil disimpan!";
        }

        // Eksekusi Query
        $hasil_query = mysqli_query($this->koneksi, $query);

        if ($hasil_query) {
            echo "<script>alert('$msg_sukses'); window.location.href='tampil.php';</script>";
            exit;
        } else {
            echo "<script>alert('Query gagal dijalankan: " . mysqli_error($this->koneksi) . "');</script>";
            return false;
        }
    }

    // ===================================================
    // Method DELETE
    // ===================================================

    public function delete_data($id_barang) {
        // Gunakan mysqli_real_escape_string untuk keamanan dasar
        $id_barang_clean = mysqli_real_escape_string($this->koneksi, $id_barang);
        
        // Ambil data lama untuk hapus gambar
        $data = $this->tampil_data_by_id($id_barang_clean);
        $gambar_lama = $data['gambar_produk'];

        // Hapus file gambar di folder
        if (file_exists('gambar/' . $gambar_lama) && $gambar_lama != 'default.png') {
            unlink('gambar/' . $gambar_lama);
        }
        
        // Query DELETE
        $query = "DELETE FROM tb_barang WHERE id_barang='$id_barang_clean'";
        $hasil_query = mysqli_query($this->koneksi, $query);

        if ($hasil_query) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='tampil.php';</script>";
            exit;
        } else {
            echo "<script>alert('Query gagal dijalankan: " . mysqli_error($this->koneksi) . "');</script>";
            return false;
        }
    }
    
    // ===================================================
    // Method Tambahan (Login, Logout, Cari, Print)
    // ===================================================
    
    public function login($username, $password) {
        // **PERBAIKAN KEAMANAN**: Bersihkan input data
        $username_clean = mysqli_real_escape_string($this->koneksi, $username);
        $password_clean = mysqli_real_escape_string($this->koneksi, $password);
        
        // CATATAN: Idealnya, password harus di-hash (misal: MD5 atau lebih baik: password_verify/password_hash)
        $query = "SELECT * FROM user WHERE username='$username_clean' AND password='$password_clean'";
        $result = mysqli_query($this->koneksi, $query);
        
        if (mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['user'] = $username_clean;
            header('location:home.php'); 
            exit;
        } else {
            echo "<script>alert('Username atau Password salah!'); window.location.href='index.php';</script>";
            exit;
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header('location:index.php'); // Kembali ke halaman login (index.php)
        exit;
    }
    
    public function satuan_print($nama_barang) {
        // Logika print satuan (dapat ditambahkan jika diperlukan)
    }
    
    // Method untuk pencarian data
    public function cari_data($cart, $kriteria) {
        // Bersihkan input untuk keamanan
        $cart = mysqli_real_escape_string($this->koneksi, $cart);
        $kriteria = mysqli_real_escape_string($this->koneksi, $kriteria);

        // Query untuk melakukan pencarian berdasarkan kriteria yang dipilih
        // CATATAN: Kriteria tidak dibersihkan sebagai string karena digunakan sebagai nama kolom, 
        // namun perlu dipastikan input kriteria hanya berisi nama kolom yang valid.
        $query = "SELECT * FROM tb_barang WHERE $kriteria LIKE '%$cart%'";
        $result = mysqli_query($this->koneksi, $query);
        
        // Logika menampilkan data atau alert
        if (mysqli_num_rows($result) > 0) {
            // Jika data ditemukan
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            // Jika data tidak ditemukan, tampilkan alert
            echo "<script>alert('Data yang dicari tidak ditemukan!');</script>";
            return []; // Mengembalikan array kosong
        }
    }

    // Method untuk menghitung total data (UNTUK PAGINATION)
    public function count_all_data() {
        $query = "SELECT COUNT(*) AS total FROM tb_barang";
        $result = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }
}
?>