<?php
class Test {
    const PI = 3.142;

    public function __construct() {
        // Constructor logic
    }

    public function __call($sname, $sarg) {
        if ($sname == 'area') {
            switch (count($sarg)) {
                case 1:
                    // Area of a circle
                    return self::PI * $sarg[0] * $sarg[0];
                case 2:
                    // Area of a rectangle
                    return $sarg[0] * $sarg[1];
                default:
                    throw new Exception("Bad argument: 'area' method expects 1 or 2 arguments.");
            }
        } else {
            throw new Exception("Function '$sname' does not exist.");
        }
    }
}

// Penggunaan
$circle = new Test();
echo "Luas Lingkaran: " . $circle->area(3) . "<br>";

$rect = new Test();
echo "Luas Persegi Panjang: " . $rect->area(8, 6) . "<br>";

?>