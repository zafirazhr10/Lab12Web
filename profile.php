<?php
// File: module/user/profile.php

// Pastikan hanya bisa diakses setelah login
if (!isset($_SESSION['is_login'])) {
    header('Location: ../user/login');
    exit();
}

$db = new Database();
$message = '';
$message_type = '';

// Logika Proses Ganti Password
if ($_POST) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($new_password) || empty($confirm_password)) {
        $message = "Password baru dan konfirmasi tidak boleh kosong.";
        $message_type = 'danger';
    } elseif ($new_password !== $confirm_password) {
        $message = "Password baru dan konfirmasi tidak cocok.";
        $message_type = 'danger';
    } else {
        // --- Tugas Praktikum No. 2: Implementasi Enkripsi Password (password_hash) ---

        // 1. Enkripsi password baru
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // 2. Siapkan query UPDATE
        $username = $_SESSION['username'];
        
        // Catatan: Anda dapat menggunakan prepared statement untuk keamanan yang lebih baik,
        // tetapi untuk praktikum ini, kita gunakan string interpolation sederhana.
        $sql = "UPDATE users SET password = '{$hashed_password}' WHERE username = '{$username}'";
        
        // 3. Jalankan query
        if ($db->query($sql)) {
            $message = "Password berhasil diubah!";
            $message_type = 'success';
        } else {
            $message = "Gagal mengubah password. Coba lagi.";
            $message_type = 'danger';
        }
    }
}
?>

<div class="container mt-5">
    <h2>Profil Pengguna</h2>
    <hr>

    <?php if ($message): ?>
        <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">Detail Akun</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nama:</strong> <?= htmlspecialchars($_SESSION['nama']) ?></li>
            <li class="list-group-item"><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></li>
        </ul>
    </div>

    <div class="card">
        <div class="card-header">Ubah Password</div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-warning">Ganti Password</button>
            </form>
        </div>
    </div>
</div>