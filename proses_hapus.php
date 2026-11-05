<?php
require_once __DIR__ . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php?pages=produk");
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    die("ID produk tidak valid.");
}

// Ambil nama gambar
$stmt = mysqli_prepare($conn, "SELECT gambar FROM produk WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    die("Produk tidak ditemukan.");
}

// Hapus data produk
$stmt = mysqli_prepare($conn, "DELETE FROM produk WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    // Hapus file gambar jika ada
    if (!empty($produk['gambar'])) {
        $namaGambar = basename($produk['gambar']);
        $pathGambar = __DIR__ . '/assets/' . $namaGambar;

        if (is_file($pathGambar)) {
            unlink($pathGambar);
        }
    }

    header("Location: index.php?pages=produk");
    exit;
}

die("Gagal menghapus produk: " . mysqli_stmt_error($stmt));
?>