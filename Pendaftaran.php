<?php
// [Tahap 3] Membuat abstract class Pendaftaran dengan properti protected
abstract class Pendaftaran {
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;

    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar) {
        $this->id_pendaftaran = $id;
        $this->nama_calon = $nama;
        $this->asal_sekolah = $asal;
        $this->nilai_ujian = $nilai;
        $this->biayaPendaftaranDasar = $biaya_dasar;
    }

    // Abstract methods yang wajib di-override oleh class anak
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}
?>