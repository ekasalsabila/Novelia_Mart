<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}
?>

<div class="mb-4">
    <h4 class="fw-bold">Tambah Produk</h4>
    <p class="text-secondary">Masukkan informasi produk baru.</p>
</div>

<div class="card p-4">
    <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control"
                   placeholder="Masukkan nama barang" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                   min="0" step="0.01" placeholder="Masukkan harga" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control"
                   min="0" placeholder="Masukkan jumlah stok" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   placeholder="Contoh: Fiksi, Non Fiksi" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Gambar Produk</label>
            <input type="file" name="gambar" class="form-control"
                   accept=".jpg,.jpeg,.png,.webp">
            <small class="text-secondary">Format JPG, JPEG, PNG, atau WEBP.</small>
        </div>

        <button type="submit" class="btn btn-pink">
            <i class="bi bi-save me-1"></i> Simpan Produk
        </button>

        <a href="index.php?pages=produk" class="btn btn-secondary">
            Batal
        </a>

    </form>
</div>