<?php

$pinjaman = 1000000;
$bunga = 10; //persen
$lamaAngsuran = 5; // bulan
$telatHari = 40;

// Hitung total pinjaman (pokok + bunga)
$totalPinjaman = $pinjaman + ($pinjaman * $bunga / 100);

// Hitung angsuran per bulan
$angsuran = $totalPinjaman / $lamaAngsuran;

// Hitung denda (0.15% per hari dari angsuran)
$dendaPerHari = 0.0015 * $angsuran;
$totalDenda = $telatHari * $dendaPerHari;

// Total pembayaran
$totalBayar = $angsuran + $totalDenda;


echo "Total Pinjaman : Rp " . number_format($totalPinjaman, 0, ',', '.') . "<br>";
echo "Angsuran per bulan : Rp " . number_format($angsuran, 0, ',', '.') . "<br>";
echo "Keterlambatan (hari) : $telatHari <br>";
echo "Total Denda : Rp " . number_format($totalDenda, 0, ',', '.') . "<br>";
echo "Total Pembayaran : Rp " . number_format($totalBayar, 0, ',', '.');
?>
