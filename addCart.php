<?php
session_start();
include "koneksi.php";

// Cek apakah ID produk tersedia
if (!isset($_GET['p'])) {
    echo json_encode(['success' => false, 'message' => 'Product ID is missing']);
    exit;
}

$id_produk = $_GET['p'];
$action = isset($_GET['action']) ? $_GET['action'] : 'add';

// Pastikan keranjang belanja sudah ada dalam sesi
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = [];
}

// Cegah SQL Injection dengan menggunakan prepared statement
if (isset($_SESSION['shopping_cart'][$id_produk])) {
    if ($action === 'increase') {
        $_SESSION['shopping_cart'][$id_produk]['quantity']++;
    } elseif ($action === 'decrease' && $_SESSION['shopping_cart'][$id_produk]['quantity'] > 1) {
        $_SESSION['shopping_cart'][$id_produk]['quantity']--;
    } elseif ($action === 'remove') {
        // Hapus produk dari keranjang
        unset($_SESSION['shopping_cart'][$id_produk]);
    } elseif ($action === 'add') {
        $_SESSION['shopping_cart'][$id_produk]['quantity']++;
    }
} else {
    // Jika produk belum ada di keranjang, tambahkan produk baru
    if ($action === 'add') {
        // Pastikan query hanya mencari produk yang ada dalam menu makanan atau minuman
        $stmt = mysqli_prepare($koneksi, "SELECT nama, harga, kategori_id FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id_produk);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan']);
            exit;
        }

        // Tambahkan produk ke keranjang belanja
        $_SESSION['shopping_cart'][$id_produk] = [
            'id' => $id_produk,
            'nama' => $product['nama'],
            'harga' => $product['harga'],
            'kategori' => $product['kategori_id'], // Perbaikan di sini
            'quantity' => 1
        ];
    }
}

// Hitung total keranjang setelah perubahan
$total = 0;
foreach ($_SESSION['shopping_cart'] as $item) {
    $total += $item['harga'] * $item['quantity'];
}

// Menghitung subtotal untuk produk tertentu
$subtotal = $_SESSION['shopping_cart'][$id_produk]['harga'] * $_SESSION['shopping_cart'][$id_produk]['quantity'];

// Kirim respons JSON dengan data yang diperbarui
echo json_encode([
    'success' => true,
    'new_quantity' => $_SESSION['shopping_cart'][$id_produk]['quantity'],
    'new_subtotal' => $subtotal,
    'new_total' => $total
]);

// Redirect ke halaman shopping cart setelah penambahan produk
header("Location: shoppingCart.php");
exit;
?>
