<?php
// File: module/home/index.php

// Pastikan $base_url didefinisikan jika belum ada dari index.php
// (Ini hanya mekanisme fallback, idealnya $base_url sudah ada dari index.php)
if (!isset($base_url)) {
    // Sesuaikan "lab12_php" jika nama folder proyek Anda berbeda.
    $base_url = "/lab12_php"; 
}
?>
<div class="mt-5">
    <h1>Selamat Datang di Sistem Informasi Artikel</h1>
    <p>Silakan gunakan menu navigasi di atas.</p>
    <?php if (isset($_SESSION['is_login'])): ?>
        <p>Anda telah login sebagai **<?= htmlspecialchars($_SESSION['nama']) ?>**.</p>
        <p>Akses menu "Data Artikel" untuk mengelola data atau "Profil" untuk mengubah password Anda.</p>
    <?php else: ?>
        <p>Silakan <a href="<?= $base_url ?>/index.php/user/login">Login</a> untuk mengakses menu administrasi.</p>
    <?php endif; ?>
</div>