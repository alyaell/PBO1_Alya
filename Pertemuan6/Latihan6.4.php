<?php

class manusia {
    // property
    public $nama;
    public $warna;

    //method construct di jalankan pertama kali
    function __construct() {
        echo "Ini adalah isi method construct <br>";
    }

    //method destruct di jalankan terakhir
    function __destruct() {
        echo "Ini adalah isi method destruct <br>";
    }

    //method manusia
    function tampilkan_nama() {
        return "Nama saya mahasiswa SI <br>";
    }
}

//instansiasi class manusia
$manusia = new manusia();

//memanggil method tampilkan_nama dari class manusia
echo $manusia->tampilkan_nama();

?>