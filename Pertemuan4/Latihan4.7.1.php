<h1>
<?php 
class Perulangan { 
    public function loop() { 
        for ($i = 0; $i <= 5; $i++) { 
            echo "Nilai i = $i <br />"; 
        } 
    } 
} 
$ObjekPerulangan = new Perulangan(); 
echo "Jenis Perulangan : <br />"; 
echo $ObjekPerulangan->loop() . "<br />"; 
?> 

