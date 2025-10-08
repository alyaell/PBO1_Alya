<?php
// ... (class customException) ...

echo "<h2>DEMO A: Memicu Custom Exception (Format Salah)</h2>";
$email = "someone@example..com"; // Format salah, mengandung 'example'

try {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        // Melempar customException karena format email salah
        throw new customException($email); 
    }
    
    // Baris ini TIDAK akan dieksekusi karena exception sudah dilempar di atas
    if(strpos($email, "example") === FALSE) {
        throw new Exception("email is an example e-mail");
    }
} 
catch (customException $e) {
    echo $e->errorMessage(); // <-- Output akan muncul di sini
}
catch (Exception $e) {
    echo $e->getMessage();
}
// ...
?>