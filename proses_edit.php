<?php
require_once __DIR__ . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php?pages=produk");
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$nama = trim($_POST['nama_barang'] ?? '');
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

if ($id <= 0 || $nama === '' || $kategori === ''
    || !is_numeric($harga) || !is_numeric($stok)
    || $harga < 0 || $stok < 0) {
    die("Data produk tidak valid.");
}

// Ambil gambar lama
$stmt = mysqli_prepare($conn, "SELECT gambar FROM produk WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$dataLama = mysqli_fetch_assoc($result);

if (!$dataLama) {
    die("Produk tidak ditemukan.");
}

$namaGambar = $dataLama['gambar'];
$gambarBaru = '';

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        die("Gagal mengunggah gambar.");
    }

    $ekstensi = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    $formatDiizinkan = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ekstensi, $formatDiizinkan, true)) {
        die("Format gambar tidak diizinkan.");
    }

    if ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
        die("Ukuran gambar maksimal 2 MB.");
    }

    if (getimagesize($_FILES['gambar']['tmp_name']) === false) {
        die("File yang diunggah bukan gambar yang valid.");
    }

    $folder = __DIR__ . '/assets/';
    $gambarBaru = uniqid('produk_', true) . '.' . $ekstensi;

    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $gambarBaru)) {
        die("Gambar gagal disimpan.");
    }

    $namaGambar = $gambarBaru;
}

$sql = "UPDATE produk
        SET nama_barang = ?, harga = ?, stok = ?, kategori = ?, gambar = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sdissi", $nama, $harga, $stok, $kategori, $namaGambar, $id);

if (mysqli_stmt_execute($stmt)) {

    // Hapus gambar lama setelah data berhasil diperbarui
    if ($gambarBaru !== '' && !empty($dataLama['gambar'])) {
        $gambarLama = basename($dataLama['gambar']);
        $pathLama = __DIR__ . '/assets/' . $gambarLama;

        if (is_file($pathLama)) {
            unlink($pathLama);
        }
    }

    header("Location: index.php?pages=produk");
    exit;
}

// Jika update gagal, hapus file gambar baru
if ($gambarBaru !== '') {
    unlink(__DIR__ . '/assets/' . $gambarBaru);
}

die("Gagal memperbarui produk: " . mysqli_stmt_error($stmt));
?>