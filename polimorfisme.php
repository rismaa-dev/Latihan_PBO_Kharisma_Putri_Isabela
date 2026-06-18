<?php
// [Tahap 4] Membuat subclass PendaftaranKedinasan
require_once 'Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    private $skIkatanDinas;
    private $instansiSponsor;

    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $sk, $sponsor) {
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        $this->skIkatanDinas = $sk;
        $this->instansiSponsor = $sponsor;
    }

    // [Tahap 4] Metode Query Spesifik Jalur Kedinasan
    public static function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // [Tahap 5] Overriding hitungTotalBiaya (Surcharge 25% atau dikali 1.25)
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar * 1.25;
    }

    public function tampilkanInfoJalur() {
        return "Sponsor: " . $this->instansiSponsor . " (SK: " . $this->skIkatanDinas . ")";
    }
}
?>