<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi.php sudah berisi koneksi ke database

// Pastikan order_id diterima dari URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Query untuk mengambil data pesanan berdasarkan order_id
    $query = "SELECT name, address, phone FROM orders WHERE id = ?";
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Bind parameter dan execute query
        mysqli_stmt_bind_param($stmt, "i", $order_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nama, $alamat, $phone);

        // Cek apakah data ditemukan
        if (mysqli_stmt_fetch($stmt)) {
            // Data ditemukan, tampilkan informasi pesanan
            echo "<div class='order-card'>";
            echo "<h2>Terima Kasih, Pesanan Anda Telah Diterima</h2>";
            echo "<p><strong>Pesanan atas nama:</strong> " . htmlspecialchars($nama) . "</p>";
            echo "<p><strong>Alamat:</strong> " . htmlspecialchars($alamat) . "</p>";
            echo "<p><strong>Telepon:</strong> " . htmlspecialchars($phone) . "</p>";
            echo "<p><strong>ID Pesanan:</strong> " . htmlspecialchars($order_id) . "</p>";
            echo "<p>Silakan transfer ke rekening kami atau pilih metode pembayaran yang Anda pilih.</p>";
            echo "</div>";
        } else {
            // Jika pesanan tidak ditemukan
            echo "<p>Pesanan tidak ditemukan.</p>";
        }

        // Menutup statement
        mysqli_stmt_close($stmt);
    } else {
        // Error pada query
        echo "<p>Terjadi kesalahan saat mengambil data pesanan.</p>";
    }
} else {
    // Jika order_id tidak ditemukan di URL
    echo "<p>Pesanan tidak ditemukan.</p>";
}
?>

<!-- Style untuk tampilan kartu -->
<style>
    .order-card {
        width: 80%;
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: left;
        font-family: Arial, sans-serif;
    }

    .order-card h2 {
        color: #4CAF50;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .order-card p {
        font-size: 16px;
        color: #555;
        line-height: 1.5;
        margin: 5px 0;
    }

    .order-card p strong {
        color: #333;
    }
</style>
