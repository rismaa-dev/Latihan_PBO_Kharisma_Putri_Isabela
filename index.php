<?php
// [Tahap 6] Membuat halaman antarmuka utama
require_once 'database.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

$database = new Database();
$db = $database->getConnection();

// Mengambil data spesifik lewat static method masing-masing class
$dataReguler = PendaftaranReguler::getDaftarReguler($db);
$dataPrestasi = PendaftaranPrestasi::getDaftarPrestasi($db);
$dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem PMB Jalur Spesifik</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .prestasi th { background-color: #2196F3; }
        .kedinasan th { background-color: #ff9800; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h1>Sistem Pendaftaran Mahasiswa Baru (PMB)</h1>
    <hr>

    <h2>1. Jalur Reguler</h2>
    <table>
        <tr>
            <th>ID</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Biaya Dasar</th><th>Atribut Spesifik</th><th>Total Biaya Akhir</th>
        </tr>
        <?php foreach($dataReguler as $row): 
            $mhs = new PendaftaranReguler($row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], $row['pilihan_prodi'], $row['lokasi_kampus']);
        ?>
        <tr>
            <td><?= $row['id_pendaftaran'] ?></td>
            <td><?= $row['nama_calon'] ?></td>
            <td><?= $row['asal_sekolah'] ?></td>
            <td><?= $row['nilai_ujian'] ?></td>
            <td>Rp <?= number_format($row['biaya_pendaftaran_dasar'], 0, ',', '.') ?></td>
            <td><?= $mhs->tampilkanInfoJalur() ?></td>
            <td><strong>Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.') ?></strong></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>2. Jalur Prestasi</h2>
    <table class="prestasi">
        <tr>
            <th>ID</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Biaya Dasar</th><th>Atribut Spesifik</th><th>Total Biaya Akhir (Diskon Rp50rb)</th>
        </tr>
        <?php foreach($dataPrestasi as $row): 
            $mhs = new PendaftaranPrestasi($row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], $row['jenis_prestasi'], $row['tingkat_prestasi']);
        ?>
        <tr>
            <td><?= $row['id_pendaftaran'] ?></td>
            <td><?= $row['nama_calon'] ?></td>
            <td><?= $row['asal_sekolah'] ?></td>
            <td><?= $row['nilai_ujian'] ?></td>
            <td>Rp <?= number_format($row['biaya_pendaftaran_dasar'], 0, ',', '.') ?></td>
            <td><?= $mhs->tampilkanInfoJalur() ?></td>
            <td><strong>Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.') ?></strong></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>3. Jalur Kedinasan</h2>
    <table class="kedinasan">
        <tr>
            <th>ID</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Biaya Dasar</th><th>Atribut Spesifik</th><th>Total Biaya Akhir (+25% Surcharge)</th>
        </tr>
        <?php foreach($dataKedinasan as $row): 
            $mhs = new PendaftaranKedinasan($row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], $row['sk_ikatan_dinas'], $row['instansi_sponsor']);
        ?>
        <tr>
            <td><?= $row['id_pendaftaran'] ?></td>
            <td><?= $row['nama_calon'] ?></td>
            <td><?= $row['asal_sekolah'] ?></td>
            <td><?= $row['nilai_ujian'] ?></td>
            <td>Rp <?= number_format($row['biaya_pendaftaran_dasar'], 0, ',', '.') ?></td>
            <td><?= $mhs->tampilkanInfoJalur() ?></td>
            <td><strong>Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.') ?></strong></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>