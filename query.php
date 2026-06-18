<?php
// [Tahap 4] Membuat subclass PendaftaranPrestasi
require_once 'Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    private $jenisPrestasi;
    private $tingkatPrestasi;

    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $jenis, $tingkat) {
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        $this->jenisPrestasi = $jenis;
        $this->tingkatPrestasi = $tingkat;
    }

    // [Tahap 4] Metode Query Spesifik Jalur Prestasi
    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // [Tahap 5] Overriding hitungTotalBiaya (Potongan Rp50.000)
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar - 50000;
    }

    public function tampilkanInfoJalur() {
        return "Prestasi: " . $this->jenisPrestasi . " (" . $this->tingkatPrestasi . ")";
    }
}
?>