<?php
// [Tahap 3] Membuat file koneksi database menggunakan PDO
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "db_simulasi_pbo_trpl_1-a_kharisma_putri_isabela"; // Sesuaikan nama database Anda
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi database gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>