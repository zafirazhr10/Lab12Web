<?php
$password_anda = '1234'; // <-- 👈 GANTI DENGAN PASSWORD YANG ANDA INGINKAN!
$hashed_password = password_hash($password_anda, PASSWORD_DEFAULT);

echo "Password Mentah: " . $password_anda . "\n";
echo "Password Hash: " . $hashed_password . "\n";
?>