<?php
class customException extends Exception {
    public function errorMessage() {
        //error message yang lebih rapi
        $errorMsg = 'Error Line: ' . $this->getLine() . ' | File: ' . $this->getFile()
        . '<br>Pesan: ' . $this->getMessage() . '<br>Status: Bukan alamat E-Mail yang valid.';
        return $errorMsg;
    }
}

// ----------------------------------------------------------------------
// DEMO 1: Email TIDAK VALID (Memicu Exception)
// ----------------------------------------------------------------------
echo "<h2>--- DEMO 1: EMAIL TIDAK VALID ---</h2>";

$email_invalid = "someone@example..com"; 

try {
    if(!filter_var($email_invalid, FILTER_VALIDATE_EMAIL)) {
        // Exception dilempar karena email tidak valid
        throw new customException($email_invalid);
    }
    // Baris ini TIDAK akan dieksekusi
    echo "Pesan ini tidak akan muncul."; 

} catch (customException $e) {
    // Blok catch dieksekusi, memanggil metode kustom
    echo $e->errorMessage();
}

echo "<br><br>";

// ----------------------------------------------------------------------
// DEMO 2: Email VALID (Tidak Memicu Exception)
// ----------------------------------------------------------------------
echo "<h2>--- DEMO 2: EMAIL VALID ---</h2>";

$email_valid = "anda.sukses@belajar.com";

try {
    if(!filter_var($email_valid, FILTER_VALIDATE_EMAIL)) {
        // Jika validasi gagal, throw exception
        throw new customException($email_valid);
    }
    // Baris ini AKAN dieksekusi karena email valid
    echo "SUCCESS! Email **{$email_valid}** telah divalidasi dengan benar."; 

} catch (customException $e) {
    // Blok catch tidak dieksekusi
    echo "Pesan error ini tidak akan muncul.";
}

?>