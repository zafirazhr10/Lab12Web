<?php
// File: module/user/login.php

// Cek jika sudah login, langsung ke halaman admin/artikel
if (isset($_SESSION['is_login'])) { 
    header('Location: ../artikel/index'); 
    exit; 
}

$message = ""; 

// Logika Proses Login
if ($_POST) { 
    // Instansiasi objek Database harus dilakukan di dalam blok ini 
    // agar koneksi tidak dibuat jika halaman diakses via GET
    $db = new Database(); 

    // Ambil input dan sanitasi (basic)
    $username = $_POST['username']; 
    $password = $_POST['password']; 

    // Query cari user berdasarkan username
    $sql = "SELECT id, username, password, nama FROM users WHERE username = '{$username}' LIMIT 1"; 
    $result = $db->query($sql); 
    $data = $result->fetch_assoc(); 

    // Verifikasi password
    if ($data && password_verify($password, $data['password'])) { 
        // Login Sukses: Set Session
        $_SESSION['is_login'] = true; 
        $_SESSION['username'] = $data['username']; 
        $_SESSION['nama'] = $data['nama']; 

        // Redirect ke halaman admin/artikel
        // Gunakan $base_url untuk redirect absolut agar konsisten
        // ASUMSI: $base_url sudah didefinisikan di index.php
        global $base_url; // Akses variabel dari index.php jika ada
        if (isset($base_url)) {
            header('Location: ' . $base_url . '/artikel/index');
        } else {
            // Fallback jika tidak ada $base_url
            header('Location: ../artikel/index'); 
        }
        exit; 
    } else {
        $message = "Username atau password salah!"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.login-container { max-width: 400px; margin: 100px auto; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; }
</style>
</head>
<body>
<div class="login-container">
<h3 class="text-center mb-4">Login User</h3>
<?php if ($message): ?>
<div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<form method="POST" action="">
<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>
<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>
<div class="d-grid">
<button type="submit" class="btn btn-primary">Login</button>
</div>
</form>
<div class="mt-3 text-center">
    <a href="../home/index">Kembali ke Home</a> 
</div>
</div>
</body>
</html>