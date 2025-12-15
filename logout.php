<?php
// File: module/user/logout.php

session_start();
session_unset();    // Hapus semua variabel sesi
session_destroy();  // Hancurkan sesi
 
// Redirect kembali ke halaman home
header('Location: ../home/index'); 
exit();
?>