<?php
require_once __DIR__ . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php?pages=produk");
    exit;
}

$nama = trim($_POST['nama_barang'] ?? '');
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

if ($nama === '' || $kategori === '' || !is_numeric($harga)
    || !is_numeric($stok) || $harga < 0 || $stok < 0) {
    die("Data produk tidak valid.");
}

$namaGambar = '';

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        die("Gagal mengunggah gambar.");
    }

    $ekstensi = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    $formatDiizinkan = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ekstensi, $formatDiizinkan, true)) {
        die("Format gambar harus JPG, JPEG, PNG, atau WEBP.");
    }

    if ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
        die("Ukuran gambar maksimal 2 MB.");
    }

    $infoGambar = getimagesize($_FILES['gambar']['tmp_name']);

    if ($infoGambar === false) {
        die("File yang diunggah bukan gambar yang valid.");
    }

    $folder = __DIR__ . '/assets/';

    if (!is_dir($folder)) {
        mkdir($folder, 0775, true);
    }

    $namaGambar = uniqid('produk_', true) . '.' . $ekstensi;

    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $namaGambar)) {
        die("Gambar gagal disimpan.");
    }
}

$sql = "INSERT INTO produk (nama_barang, harga, stok, kategori, gambar)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Query gagal: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sdiss", $nama, $harga, $stok, $kategori, $namaGambar);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php?pages=produk");
    exit;
}

if ($namaGambar !== '') {
    unlink(__DIR__ . '/assets/' . $namaGambar);
}

die("Gagal menambahkan produk: " . mysqli_stmt_error($stmt));
?>