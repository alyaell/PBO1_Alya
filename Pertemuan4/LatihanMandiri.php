<?php

class TriangleGenerator {
    private $pattern = [];

    // Setter untuk menetapkan pola segitiga
    public function setPattern($pattern) {
        $this->pattern = $pattern;
    }

    // Getter untuk mendapatkan pola segitiga
    public function getPattern() {
        return $this->pattern;
    }

    // Metode untuk menampilkan pola
    public function displayTriangle() {
        foreach ($this->pattern as $row) {
            echo $row . "<br>";
        }
    }

    // Pola Segitiga 1: Segitiga dengan puncak di atas
    public function generateMountain() {
        $rows = 6;
        $temp_pattern = [];

        for ($i = 1; $i <= $rows; $i++) {
            $spaces = $rows - $i;
            $stars = $i;
            $row = str_repeat('&nbsp;', $spaces) . str_repeat('* ', $stars);
            $temp_pattern[] = $row;
        }

        $this->setPattern($temp_pattern);
    }
    
    // Pola Segitiga 2: Segitiga dengan puncak di bawah dan di atas
    public function generateMountain2() {
        $rows = 6;
        $temp_pattern = [];

        // Bagian atas (segitiga biasa)
        for ($i = 1; $i <= $rows; $i++) {
            $spaces = $rows - $i;
            $stars = $i;
            $row = str_repeat('&nbsp;', $spaces) . str_repeat('* ', $stars);
            $temp_pattern[] = $row;
        }
        
        // Bagian bawah (segitiga terbalik)
        for ($i = $rows - 1; $i >= 1; $i--) {
            $spaces = $rows - $i;
            $stars = $i;
            $row = str_repeat('&nbsp;', $spaces) . str_repeat('* ', $stars);
            $temp_pattern[] = $row;
        }

        $this->setPattern($temp_pattern);
    }
    
    // Pola Segitiga 3: Segitiga terbalik
    public function generateInvertedTriangle() {
        $rows = 10;
        $temp_pattern = [];

        // Bagian atas (segitiga terbalik)
        for ($i = 1; $i <= 5; $i++) {
            $spaces = 5 - $i;
            $stars = $i;
            $row = str_repeat('&nbsp;', $spaces) . str_repeat('* ', $stars);
            $temp_pattern[] = $row;
        }
        
        // Bagian bawah (segitiga terbalik yang lebih besar)
        for ($i = 5; $i >= 1; $i--) {
            $spaces = 5 - $i;
            $stars = $i;
            $row = str_repeat('&nbsp;', $spaces) . str_repeat('* ', $stars);
            $temp_pattern[] = $row;
        }

        $this->setPattern($temp_pattern);
    }
}

// Inisiasi objek
$generator = new TriangleGenerator();

echo "<h3>Pola Segitiga 1 (Gunung)</h3>";
$generator->generateMountain();
$generator->displayTriangle();

echo "<hr>";

echo "<h3>Pola Segitiga 2 (Segitiga Bertumpuk)</h3>";
$generator->generateMountain2();
$generator->displayTriangle();

echo "<hr>";

echo "<h3>Pola Segitiga 3 (Segitiga Siku-siku)</h3>";
$generator->generateInvertedTriangle();
$generator->displayTriangle();

?>