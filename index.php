<?php
// [Tahap 6] Membuat halaman antarmuka utama berbentuk Dashboard Admin
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

// Menghitung total pendaftar untuk Dashboard Stats
$totalReguler = count($dataReguler);
$totalPrestasi = count($dataPrestasi);
$totalKedinasan = count($dataKedinasan);
$totalSemua = $totalReguler + $totalPrestasi + $totalKedinasan;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin PMB Jalur Spesifik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f4f6f9;
            --sidebar-color: #2c3e50;
            --text-light: #ffffff;
            --primary: #4CAF50;
            --info: #2196F3;
            --warning: #ff9800;
            --danger: #e74c3c;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg-color); display: flex; min-height: 100vh; }

        /* Sidebar Style */
        .sidebar { width: 260px; background-color: var(--sidebar-color); color: var(--text-light); padding: 20px; flex-shrink: 0; }
        .sidebar .brand { display: flex; align-items: center; gap: 10px; font-size: 20px; font-weight: bold; padding-bottom: 20px; border-bottom: 1px solid #4f5d73; margin-bottom: 20px; }
        .sidebar .menu-item { display: flex; align-items: center; gap: 12px; padding: 12px 15px; color: #adb5bd; text-decoration: none; border-radius: 6px; margin-bottom: 8px; transition: 0.3s; }
        .sidebar .menu-item:hover, .sidebar .menu-item.active { background-color: #34495e; color: var(--text-light); }

        /* Main Content Style */
        .main-content { flex-grow: 1; padding: 30px; overflow-y: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 26px; color: #333; }
        .header .user-profile { display: flex; align-items: center; gap: 10px; font-weight: 600; color: #555; }

        /* Cards Panel (Grid) */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid transparent; }
        .stat-card.all { border-left-color: #9b59b6; }
        .stat-card.reguler { border-left-color: var(--primary); }
        .stat-card.prestasi { border-left-color: var(--info); }
        .stat-card.kedinasan { border-left-color: var(--warning); }
        .stat-card .card-info h3 { font-size: 14px; color: #888; text-transform: uppercase; margin-bottom: 5px; }
        .stat-card .card-info p { font-size: 28px; font-weight: bold; color: #333; }
        .stat-card .card-icon { font-size: 32px; opacity: 0.3; }

        /* Data Section / Tables */
        .data-section { background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 35px; }
        .section-title { display: flex; align-items: center; gap: 10px; font-size: 18px; color: #444; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f1f1f1; }
        
        table { width: 100%; border-collapse: collapse; text-align: left; }
        table th { padding: 14px 12px; font-size: 14px; font-weight: 600; color: #666; background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; }
        table td { padding: 12px; font-size: 14px; color: #555; border-bottom: 1px solid #eedee2e6; vertical-align: middle; }
        table tr:hover { background-color: #f8f9fa; }

        /* Badges Style */
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-reguler { background-color: #e8f5e9; color: var(--primary); }
        .badge-prestasi { background-color: #e3f2fd; color: var(--info); }
        .badge-kedinasan { background-color: #fff3e0; color: var(--warning); }
        .text-price { font-weight: bold; color: #2c3e50; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap"></i> PMB JALUR SPESIFIK
        </div>
        <a href="#" class="menu-item active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="#" class="menu-item"><i class="fa-solid fa-users"></i> Data Pendaftar</a>
        <a href="#" class="menu-item"><i class="fa-solid fa-gears"></i> Pengaturan</a>
    </div>

    <div class="main-content">
        
        <div class="header">
            <div>
                <h1>Dashboard Ringkasan PMB</h1>
                <p style="color: #888; font-size: 14px;">Selamat datang di Sistem Manajemen Pendaftaran Mahasiswa Baru</p>
            </div>
            <div class="user-profile">
                <i class="fa-solid fa-circle-user fa-xl"></i> Admin PMB
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card all">
                <div class="card-info">
                    <h3>Total Pendaftar</h3>
                    <p><?= $totalSemua ?></p>
                </div>
                <i class="fa-solid fa-user-group card-icon" style="color: #9b59b6;"></i>
            </div>
            <div class="stat-card reguler">
                <div class="card-info">
                    <h3>Jalur Reguler</h3>
                    <p><?= $totalReguler ?></p>
                </div>
                <i class="fa-solid fa-user-graduate card-icon" style="color: var(--primary);"></i>
            </div>
            <div class="stat-card prestasi">
                <div class="card-info">
                    <h3>Jalur Prestasi</h3>
                    <p><?= $totalPrestasi ?></p>
                </div>
                <i class="fa-solid fa-award card-icon" style="color: var(--info);"></i>
            </div>
            <div class="stat-card kedinasan">
                <div class="card-info">
                    <h3>Jalur Kedinasan</h3>
                    <p><?= $totalKedinasan ?></p>
                </div>
                <i class="fa-solid fa-building-shield card-icon" style="color: var(--warning);"></i>
            </div>
        </div>

        <div class="data-section">
            <div class="section-title">
                <i class="fa-solid fa-user-graduate" style="color: var(--primary);"></i> 
                <span>Daftar Mahasiswa Baru - Jalur Reguler</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Biaya Dasar</th><th>Keterangan Spesifik</th><th>Total Biaya Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataReguler as $row): 
                        $mhs = new PendaftaranReguler($row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], $row['pilihan_prodi'], $row['lokasi_kampus']);
                    ?>
                    <tr>
                        <td><strong>#<?= $row['id_pendaftaran'] ?></strong></td>
                        <td><?= $row['nama_calon'] ?></td>
                        <td><?= $row['asal_sekolah'] ?></td>
                        <td><span class="badge badge-reguler"><?= $row['nilai_ujian'] ?></span></td>
                        <td>Rp <?= number_format($row['biaya_pendaftaran_dasar'], 0, ',', '.') ?></td>
                        <td><i class="fa-solid fa-circle-info style='font-size:12px; color:#999'"></i> <?= $mhs->tampilkanInfoJalur() ?></td>
                        <td class="text-price">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="data-section">
            <div class="section-title">
                <i class="fa-solid fa-award" style="color: var(--info);"></i> 
                <span>Daftar Mahasiswa Baru - Jalur Prestasi</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Biaya Dasar</th><th>Keterangan Spesifik</th><th>Total Biaya Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataPrestasi as $row): 
                        $mhs = new PendaftaranPrestasi($row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], $row['jenis_prestasi'], $row['tingkat_prestasi']);
                    ?>
                    <tr>
                        <td><strong>#<?= $row['id_pendaftaran'] ?></strong></td>
                        <td><?= $row['nama_calon'] ?></td>
                        <td><?= $row['asal_sekolah'] ?></td>
                        <td><span class="badge badge-prestasi"><?= $row['nilai_ujian'] ?></span></td>
                        <td>Rp <?= number_format($row['biaya_pendaftaran_dasar'], 0, ',', '.') ?></td>
                        <td><i class="fa-solid fa-circle-info style='font-size:12px; color:#999'"></i> <?= $mhs->tampilkanInfoJalur() ?></td>
                        <td class="text-price" style="color: #2980b9;">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.') ?> <small style="color:#27ae60; font-weight:normal;">(-50k)</small></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="data-section">
            <div class="section-title">
                <i class="fa-solid fa-building-shield" style="color: var(--warning);"></i> 
                <span>Daftar Mahasiswa Baru - Jalur Kedinasan</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Biaya Dasar</th><th>Keterangan Spesifik</th><th>Total Biaya Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataKedinasan as $row): 
                        $mhs = new PendaftaranKedinasan($row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], $row['sk_ikatan_dinas'], $row['instansi_sponsor']);
                    ?>
                    <tr>
                        <td><strong>#<?= $row['id_pendaftaran'] ?></strong></td>
                        <td><?= $row['nama_calon'] ?></td>
                        <td><?= $row['asal_sekolah'] ?></td>
                        <td><span class="badge badge-warning"><?= $row['nilai_ujian'] ?></span></td>
                        <td>Rp <?= number_format($row['biaya_pendaftaran_dasar'], 0, ',', '.') ?></td>
                        <td><i class="fa-solid fa-circle-info style='font-size:12px; color:#999'"></i> <?= $mhs->tampilkanInfoJalur() ?></td>
                        <td class="text-price" style="color: #d35400;">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.') ?> <small style="color:#c0392b; font-weight:normal;">(+25%)</small></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>