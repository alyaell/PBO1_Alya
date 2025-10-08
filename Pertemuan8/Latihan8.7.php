<?php
//create function with an exception
function checkNum($number) {
    if($number > 1) {
        // Melempar Exception jika nilainya terlalu besar
        throw new Exception("Value must be 1 or below");
    }
    return true;
}

//trigger exception dengan try...catch
try {
    // Blok 'try' mencoba mengeksekusi kode yang berpotensi gagal
    checkNum(2);
    
    // Baris ini tidak akan tereksekusi jika exception terjadi
    echo "Ini tidak akan ditampilkan."; 

} catch (Exception $e) {
    // Blok 'catch' menangkap Exception yang dilempar
    // $e->getMessage() mengambil pesan kesalahan ("Value must be 1 or below")
    echo "Terjadi Exception: " . $e->getMessage() . "<br>";
}

// Kode di luar try-catch akan tetap berjalan
echo "Eksekusi skrip berlanjut.";
?>