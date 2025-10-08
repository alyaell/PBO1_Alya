<?php

// ----------------------------------------------------------------------
// 1. CUSTOM EXCEPTION CLASS
// ----------------------------------------------------------------------
class customException extends Exception {
    public function errorMessage() {
        // Ambil pesan dasar (yang berisi alamat email) dan tambahkan detail
        return 'Error caught on line ' . $this->getLine() . ' in ' . $this->getFile() 
             . '. ' . $this->getMessage() . ' is not a valid E-Mail address';
    }
}

// Custom Exception tambahan untuk pengecekan spesifik (seperti pada output Anda)
class keywordException extends Exception {
    // Tidak perlu fungsi errorMessage() kustom karena kita akan menggunakan getMessage()
}

// ----------------------------------------------------------------------
// 2. DATA ARRAY DAN VARIABEL COUNTING
// ----------------------------------------------------------------------
$emails = [
    'lab4@polis.ac.id',              // VALID & mengandung 'lab4'
    'lab4b@polis.ac.id',             // VALID & mengandung 'lab4b'
    'lab5@polis.ac.id',              // VALID & mengandung 'lab5'
    'someone@example..com',          // TIDAK VALID format
    'test@polis.ac.id',              // VALID, tapi TIDAK mengandung 'lab4' atau 'lab5'
];

$valid_count = 0;
$invalid_count = 0;
$lab4_count = 0;
$lab5_count = 0;
$other_count = 0;

$keyword_checks = ['lab4', 'lab5'];

echo "<h3>-- Pengecekan dan Validasi Email --</h3>";

// ----------------------------------------------------------------------
// 3. PERULANGAN DAN VALIDASI
// ----------------------------------------------------------------------
foreach ($emails as $email) {
    echo $email . " | ";
    
    // Asumsi awal: valid
    $is_valid = true;

    try {
        // Pengecekan 1: Validasi Format Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            // Jika format salah, lempar Custom Exception (Invalid Format)
            throw new customException($email . " tidak valid");
        }
        
        // Pengecekan 2: Validasi Keyword
        $found_keyword = false;
        foreach ($keyword_checks as $keyword) {
            if (strpos($email, $keyword) !== FALSE) {
                echo "mengandung kata '{$keyword}' | ";
                
                // Tambahkan hitungan untuk keyword
                if ($keyword == 'lab4') $lab4_count++;
                if ($keyword == 'lab5') $lab5_count++;
                
                $found_keyword = true;
                break; // Hentikan loop keyword jika sudah ditemukan
            }
        }
        
        if (!$found_keyword) {
            // Jika valid secara format tapi TIDAK mengandung keyword yang diminta
            throw new keywordException("Email {$email} tidak mengandung kata 'lab4' atau 'lab5'");
        }
        
        // Jika kode sampai di sini, email dinyatakan Valid
        echo "dan E-mail valid<br>";
        $valid_count++;

    } catch (customException $e) {
        // Menangkap Custom Exception (Format salah)
        echo $e->errorMessage() . "<br>";
        $invalid_count++;
        $is_valid = false;
        
    } catch (keywordException $e) {
        // Menangkap Keyword Exception (Format benar, tapi keyword salah)
        echo $e->getMessage() . " dan E-mail tidak valid<br>";
        $invalid_count++;
        $other_count++; // Hitung sebagai email valid format tapi salah kategori
        $is_valid = false;
    }
}

// ----------------------------------------------------------------------
// 4. HASIL AKHIR (COUNTING)
// ----------------------------------------------------------------------
echo "<hr>";
echo "<h3>-- Hasil Akhir Counting Data Email --</h3>";
echo "Total email valid (mengandung 'lab4' atau 'lab5'): **{$valid_count}**<br>";
echo "Total email tidak valid (format salah atau keyword salah): **{$invalid_count}**<br>";
echo "Terdapat {$lab4_count} email lab 4 dan {$lab5_count} email lab 5<br>";
echo "Terdapat {$other_count} email bukan lab4/lab5 (tapi format valid)<br>";
echo "Email total: " . count($emails);
?>