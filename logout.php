<?php
session_start();
session_destroy();
echo "Logout berhasil!"; // Cek jika kode dijalankan
header('location:login.php');
exit();
?>
