<?php
// [Tahap 4] Membuat subclass PendaftaranReguler
require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    private $pilihanProdi;
    private $lokasiKampus;

    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $prodi, $lokasi) {
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        $this->pilihanProdi = $prodi;
        $this->lokasiKampus = $lokasi;
    }

    // [Tahap 4] Metode Query Spesifik Jalur Reguler
    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // [Tahap 5] Overriding hitungTotalBiaya (Reguler = Biaya Dasar)
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar;
    }

    // [Tahap 6] Implementasi info spesifik
    public function tampilkanInfoJalur() {
        return "Prodi: " . $this->pilihanProdi . " (" . $this->lokasiKampus . ")";
    }
}
?>