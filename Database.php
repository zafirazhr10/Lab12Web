

<?php
class Database {
    private $conn;

    public function __construct() {
        // Objek mysqli akan mencoba koneksi
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Cek jika koneksi gagal (Penyebab utama error di line 5)
        if ($this->conn->connect_error) {
            // Tampilkan error koneksi yang jelas
            die("Koneksi Database Gagal: Cek XAMPP/DB_NAME di config.php. Error: " . $this->conn->connect_error);
        }
    }

    // Fungsi untuk menjalankan query SQL
    public function query($sql) {
        $result = $this->conn->query($sql);
        
        // Cek jika query gagal (opsional untuk debugging)
        if (!$result) {
            // Anda bisa mengaktifkan baris di bawah ini untuk melihat error query
            // die("Query Gagal: " . $this->conn->error . "\nSQL: " . $sql);
        }
        return $result;
    }
}
?>