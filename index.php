<?php

require_once __DIR__ . '/Rekening.php';
require_once __DIR__ . '/Siswa.php';

// Membuat object rekening
$rekeningAndi = new Rekening('001', 'Andi');
$rekeningSiti = new Rekening('002', 'Siti');

echo "<h1>Lab Sheet Pertemuan 3</h1>";
echo "<h2>Simulasi Rekening Bank</h2>";

// Transaksi rekening Andi
$rekeningAndi->setor(100000);

echo "Setor Rp100.000 ke rekening Andi: Berhasil<br>";

$rekeningAndi->tarik(20000);

echo "Tarik Rp20.000 dari rekening Andi: Berhasil<br>";

// Transfer ke rekening Siti
$transfer = $rekeningAndi->transfer(
    $rekeningSiti,
    30000
);

echo "Transfer Rp30.000 ke Siti: "
    . ($transfer ? "Berhasil" : "Ditolak") . "<br>";

echo "<hr>";

// Menampilkan saldo
echo "<b>Saldo Andi:</b> Rp"
    . number_format($rekeningAndi->getSaldo(), 0, ',', '.') . "<br>";

echo "<b>Saldo Siti:</b> Rp"
    . number_format($rekeningSiti->getSaldo(), 0, ',', '.') . "<br>";

// Menampilkan riwayat transaksi
echo "<h3>Riwayat Transaksi Andi</h3>";

foreach ($rekeningAndi->getRiwayat() as $transaksi) {
    echo $transaksi['jenis']
        . " - Rp"
        . number_format($transaksi['jumlah'], 0, ',', '.')
        . "<br>";
}

// Membuat object siswa
echo "<h2>Validasi Data Siswa</h2>";

$siswa = new Siswa();

$namaValid = $siswa->setNama('Budi');
$nilaiValid = $siswa->setNilai(85);

$nilaiTidakValid = $siswa->setNilai(150);
$namaTidakValid = $siswa->setNama('   ');

echo "Set nama Budi: "
    . ($namaValid ? "Diterima" : "Ditolak") . "<br>";

echo "Set nilai 85: "
    . ($nilaiValid ? "Diterima" : "Ditolak") . "<br>";

echo "Set nilai 150: "
    . ($nilaiTidakValid ? "Diterima" : "Ditolak") . "<br>";

echo "Set nama kosong: "
    . ($namaTidakValid ? "Diterima" : "Ditolak") . "<br>";

echo "<br>";

echo "<b>Nama Siswa:</b> "
    . htmlspecialchars($siswa->getNama()) . "<br>";

echo "<b>Nilai Siswa:</b> "
    . $siswa->getNilai() . "<br>";

// Dua contoh akses ilegal yang ditolak PHP:

// $rekeningAndi->saldo = 500000;
// Error: Cannot access private property Rekening::$saldo

// $siswa->nilai = 150;
// Error: Cannot access private property Siswa::$nilai