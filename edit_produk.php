<?php
$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    echo "<div class='alert alert-warning'>Produk tidak ditemukan.</div>";
    return;
}
?>

<div class="mb-4">
    <h4 class="fw-bold">Edit Produk</h4>
    <p class="text-secondary">Perbarui informasi produk.</p>
</div>

<div class="card p-4">

    <form action="proses_edit.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $produk['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control"
                   value="<?= htmlspecialchars($produk['nama_barang']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                   min="0" step="0.01"
                   value="<?= htmlspecialchars($produk['harga']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control"
                   min="0" value="<?= htmlspecialchars($produk['stok']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   value="<?= htmlspecialchars($produk['kategori']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label>
            <div class="mb-2">
                <?php if (!empty($produk['gambar'])): ?>
                    <img src="assets/<?= htmlspecialchars(basename($produk['gambar'])); ?>"
                         width="100" height="100"
                         style="object-fit:cover; border-radius:10px;"
                         alt="Gambar produk">
                <?php else: ?>
                    <p class="text-secondary">Belum ada gambar.</p>
                <?php endif; ?>
            </div>

            <label class="form-label">Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" class="form-control"
                   accept=".jpg,.jpeg,.png,.webp">
            <small class="text-secondary">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        <button type="submit" class="btn btn-pink">
            <i class="bi bi-save me-1"></i> Simpan Perubahan
        </button>

        <a href="index.php?pages=produk" class="btn btn-secondary">
            Batal
        </a>

    </form>
</div>